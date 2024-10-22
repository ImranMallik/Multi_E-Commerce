<?php

return [
  'order_status_admin' => [
    'pending' => [
      'status' => 'pending',
      'details' => 'Your order is currently pending'
    ],
    'processed_and_ready_to_ship' => [
      'status' => 'processed and ready to ship',
      'details' => 'Your package has been processed and will be with our delivery partner soon'
    ],
    'dropped_off' => [
      'status' => 'Dropped off',
      'details' => 'Your package has been dropped off by the seller'
    ],
    'shipped' => [
      'status' => 'shipped',
      'details' => 'Your package has arrived at your logistics facility'
    ],
    'out_of_delivery' => [
      'status' => 'out for delivery',
      'details' => 'Your package is out for delivery'
    ],
    'delivered' => [
      'status' => 'Delivered',
      'details' => 'Your package has been delivered'
    ],
    'canceled' => [
      'status' => 'Canceled',
      'details' => 'Canceled'
    ]
  ],
  'order_status_vendor' => [
    'pending' => [
      'status' => 'pending',
      'details' => 'Your order is currently pending'
    ],
    'processed_and_ready_to_ship' => [
      'status' => 'processed and ready to ship',
      'details' => 'Your package has been processed and will be with our delivery partner soon'
    ],
  ]
];
