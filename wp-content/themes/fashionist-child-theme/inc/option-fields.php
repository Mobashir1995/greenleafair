<?php
add_filter('redux/options/fashionist_options/section/header', 'pd_fashion_header_options');
function pd_fashion_header_options($section){
    $section['fields'][] = array(
        'id'       => 'callus_top_text',
        'type'     => 'text',
        'title'    => __('Call Us Top Text', 'fashionist'),
        'default'  => 'Call Today {{phone_number}}'
    );
    $section['fields'][] = array(
        'id'       => 'callus_bottom_text',
        'type'     => 'text',
        'title'    => __('Call Us Bottom Text', 'fashionist'),
        'default'  => 'Manhattan, NY 10039'
    );
    $section['fields'][] = array(
        'id'       => 'review_one',
        'type'     => 'editor',
        'title'    => __('Review One', 'fashionist'),
        'default'  => '',
        'args'     => array(
            'textarea_rows' => 4
        )
    );
    $section['fields'][] = array(
        'id'       => 'review_two',
        'type'     => 'editor',
        'title'    => __('Review Two', 'fashionist'),
        'default'  => '',
        'args'     => array(
            'textarea_rows' => 4
        )
    );
    $section['fields'][] = array(
        'id'       => 'scheduled_appoint_text',
        'type'     => 'text',
        'title'    => __('Schedule Appointment Text', 'fashionist'),
        'default'  => 'Schedule an Appointment'
    );
    $section['fields'][] = array(
        'id'       => 'scheduled_appoint_url',
        'type'     => 'text',
        'title'    => __('Schedule Appointment Link', 'fashionist'),
        'default'  => '#'
    );
    $section['fields'][] = array(
        'id'       => 'logo',
        'type'     => 'media',
        'title'    => __('Logo', 'fashionist'),
        'default'  => '',
        'desc'     => __('Upload Website Logo from here')
    );
    return $section;
}