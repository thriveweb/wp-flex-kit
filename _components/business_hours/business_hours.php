<?php

/**
* Theme for business hours
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/
$custom_args = array(
  'day_format' => 'full', // full || short || char
  'combine_duplicates' => false,
  'week_start' => 'monday' // monday || sunday
);

/**
* Business_hours
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('business_hours')) {
  function business_hours(array $args) {
    ob_start();
    if (($business_hours = $args['acf_content']['business_hours']) && is_array($business_hours)) :
      $business_hours = order_weekdays($business_hours);
      $business_hours = format_days($business_hours, $args['day_format']);
      if ($args['combine_duplicates']) $business_hours = combine_duplicates($business_hours);
      ?>
      <p <?= $args['id'] ?> class="business-hours <?= $args['classes'] ?>">
        <?php foreach ($business_hours as $business_hour) : ?>
          <?= $business_hour['day']['label'] . ': ' . str_replace(' ', '', $business_hour['time'][0]['from']) . ' - ' . str_replace(' ', '', $business_hour['time'][0]['till']) ?> <br />
        <?php endforeach ?>
      </p>
    <?php endif;
    return ob_get_clean();
  }
}

if (!function_exists('order_weekdays')) {
  function order_weekdays(array $business_hours, $week_start = 'monday') {
    $day_order = array('monday' => 0, 'tuesday' => 1, 'wednesday' => 2, 'thursday' => 3, 'friday' => 4, 'saturday' => 5, 'sunday' => 6);
    if ($week_start === 'sunday') {
      $new_day_order = array();
      foreach ($day_order as $day => $num) {
        if ($day !== 'sunday') $new_day_order[$day] = $num + 1;
        else $new_day_order[$day] = 0;
      }
      $day_order = $new_day_order;
    }
    $result_clean = array();
    foreach ($business_hours as $item) {
      if (array_key_exists($item['day']['value'], $day_order)) $result_clean[intval($day_order[$item['day']['value']])] = $item;
    }
    ksort($result_clean);
    return $result_clean;
  }
}

if (!function_exists('format_days')) {
  function format_days(array $business_hours, $format = 'full') {
    foreach ($business_hours as &$variation) {
      $day = $variation['day']['label'];
      $end = 1;
      if ($format === 'short') $end = 3;
      if ($format === 'full') $end = strlen($day);
      $variation['day']['label'] = ucFirst(trim(substr($day, 0, $end)));
    }
    return $business_hours;
  }
}

if (!function_exists('combine_duplicates')) {
  function combine_duplicates(array $business_hours) {
    $start_day = false;
    $last_day = false;
    $end_day = false;
    $last_start_time = false;
    $last_end_time = false;
    $prev_time = false;
    $new_busness_hours = array();
    $i = 0;
    foreach ($business_hours as $variation) {
      $i++;
      if (!$start_day) $start_day = $variation['day']['label'];
      if (!$last_start_time) $last_start_time = $variation['time'][0]['from'];
      if (!$last_end_time) $last_end_time = $variation['time'][0]['till'];
      if ($last_start_time !== $variation['time'][0]['from'] || $last_end_time !== $variation['time'][0]['till'] && $i !== count($business_hours)) {
        if ($start_day !== $last_day) $end_day = $last_day;
        $label = $start_day . ($end_day ? ' - ' . $end_day : '');
        $new_busness_hours[] = array( 'day' => array('label' => $label), 'time' => $prev_time );
        $start_day = $variation['day']['label'];
        $last_start_time = $variation['time'][0]['from'];
        $last_end_time = $variation['time'][0]['till'];
        $end_day = false;
        $last_day = false;
        $prev_time = false;
      }
      if ($i === count($business_hours)) {
        if ($last_start_time === $variation['time'][0]['from'] && $last_end_time === $variation['time'][0]['till']) {
          if ($start_day !== $variation['day']['label']) $end_day = $variation['day']['label'];
          $label = $start_day . ($end_day ? ' - ' . $end_day : '');
          $new_busness_hours[] = array( 'day' => array('label' => $label), 'time' => $prev_time ? $prev_time : $variation['time'] );
          $last_start_time = $variation['time'][0]['from'];
          $last_end_time = $variation['time'][0]['till'];
          $end_day = false;
          $last_day = false;
          $prev_time = false;
        } else {
          if ($last_start_time === $variation['time'][0]['from'] && $last_end_time !== $variation['time'][0]['till']) {
            if ($start_day !== $last_day) $end_day = $last_day;
            $label = $start_day . ($end_day ? ' - ' . $end_day : '');
            $new_busness_hours[] = array( 'day' => array('label' => $label), 'time' => $prev_time );
          }
          $new_busness_hours[] = array( 'day' => $variation['day'], 'time' => $variation['time'] );
        }
      }
      $last_day = $variation['day']['label'];
      $prev_time = $variation['time'];
    }
    return $new_busness_hours;
  }
}
