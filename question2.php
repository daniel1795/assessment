<?php
/**
 * Sorts data in a multi-dimensional array based on specified keys
 *
 * @param array $data The array to be sorted
 * @param array $sortBy The keys to sort the data by
 * @param string $source The source identifier, "root" by default
 *
 * @return array|null The sorted array or null
 * */
function sortData(array $data, array $sortBy, $source = "root")
{
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            // Sort data recursively within subarrays.
            $resp = sortData($value, $sortBy, "recursion");
            // Store the required data to be sorted according specified keys
            if (isset($resp)) {
                if (!isset($temp)) {
                    $temp = [];
                }
                $temp = array_merge($temp, array_values($resp));
            }
        }
        // Store the required data to be sorted according specified keys
        foreach ($sortBy as $ks => $sort) {
            if (isset($value[$sort])) {
                $temp[$key][$ks][$sort] = $value[$sort];
            }
        }
    }

    // If the source is "root", sort the data stored in $temp
    if ($source == "root") {
        uasort(
            $temp,
            function ($a, $b) {
                ksort($a);
                foreach ($a as $key => $value) {
                    // Compare values
                    $cmp = strnatcmp(current($a[$key]), current($b[$key] ?? []));
                    if ($cmp !== 0) {
                        return $cmp;
                    }
                }
                return 0;
            }
        );
        // Reorder the original data based on the sorted temporary array
        $out = [];
        foreach ($temp as $kt => $vt) {
            $out[$kt] = $data[$kt];
        }

        return $out;
    }

    return $temp ?? null;
}


$data = [
    [
        'guest_id'      => 177,
        'guest_type'    => 'crew',
        'first_name'    => 'Marco',
        'middle_name'   => null,
        'last_name'     => 'Burns',
        'gender'        => 'M',
        'guest_booking' => [
            [
                'booking_number' => 20008683,
                'ship_code'      => 'OST',
                'room_no'        => 'A0073',
                'start_time'     => 1438214400,
                'end_time'       => 1483142400,
                'is_checked_in'  => true,
            ],
        ],
        'guest_account' => [
            [
                'account_id'    => 20009503,
                'status_id'     => 2,
                'account_limit' => 0,
                'allow_charges' => true,
            ],
        ],
    ],
    [
        'guest_id'      => 10000113,
        'guest_type'    => 'crew',
        'first_name'    => 'Bob Jr ',
        'middle_name'   => 'Charles',
        'last_name'     => 'Hemingway',
        'gender'        => 'M',
        'guest_booking' => [
            [
                'booking_number' => 10000013,
                'room_no'        => 'B0092',
                'is_checked_in'  => true,
                'end_time'       => 1583142400,
            ],
        ],
        'guest_account' => [
            [
                'account_id'    => 10000522,
                'account_limit' => 300,
                'allow_charges' => true,
            ],
        ],
    ],
    [
        'guest_id'      => 10000114,
        'guest_type'    => 'crew',
        'first_name'    => 'Al ',
        'middle_name'   => 'Bert',
        'last_name'     => 'Santiago',
        'gender'        => 'M',
        'guest_booking' => [
            [
                'booking_number' => 10000014,
                'room_no'        => 'A0018',
                'is_checked_in'  => true,
            ],
        ],
        'guest_account' => [
            [
                'account_id'    => 10000013,
                'account_limit' => 300,
                'allow_charges' => false,
            ],
        ],
    ],
    [
        'guest_id'      => 10000115,
        'guest_type'    => 'crew',
        'first_name'    => 'Red ',
        'middle_name'   => 'Ruby',
        'last_name'     => 'Flowers ',
        'gender'        => 'F',
        'guest_booking' => [
            [
                'booking_number' => 10000015,
                'room_no'        => 'A0051',
                'is_checked_in'  => true,
            ],
        ],
        'guest_account' => [
            [
                'account_id'    => 10000519,
                'account_limit' => 300,
                'allow_charges' => true,
            ],
        ],
    ],
    [
        'guest_id'      => 10000116,
        'guest_type'    => 'crew',
        'first_name'    => 'Ismael ',
        'middle_name'   => 'Jean-Vital',
        'last_name'     => 'Jammes',
        'gender'        => 'M',
        'guest_booking' => [
            [
                'booking_number' => 10000016,
                'room_no'        => 'A0023',
                'is_checked_in'  => true,
            ],
        ],
        'guest_account' => [
            [
                'account_id'    => 10000015,
                'account_limit' => 300,
                'allow_charges' => true,
            ],
        ],
    ],
];

// Call the function to sort the above data
$temp = sortData($data, ["last_name", "account_id"]);
// Print the sorted data
print_r($temp);