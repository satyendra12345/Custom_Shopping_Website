     <?php
    return [
        'user' => [

            'login' => [
                'LoginForm[username]' => 'harman',
                'LoginForm[password]' => 'admin',
                'LoginForm[device_token]' => '12131313',
                'LoginForm[device_type]' => '1',
                'LoginForm[device_name]' => '1'
            ],

            'check' => [
                'DeviceDetail[device_token]' => 'harman',
                'DeviceDetail[device_type]' => 'admin',
                'DeviceDetail[device_name]' => '12131313'
            ],
            'signup' => [
                'User[full_name]' => 'Test String',
                'User[email]' => 'Trand' . rand(0, 499) . 'est@' . rand(0, 499) . 'String.com',
                'User[password]' => 'Test String',

                'User[contact_no]' => 'Test String'
            ],
            'change-password' => [
                'User[oldPassword]' => 'Test String',
                'User[newPassword]' => 'Test String',
                'User[confirm_password]' => 'Test String'
            ],
            'social-login' => [
                'User[contact_no]' => '',
                'User[username]' => '',
                'User[first_name]' => '',
                'User[last_name]' => '',
                'User[userId]' => '',
                'User[provider]' => '',
                'User[state]' => '',
                'User[city]' => '',
                'User[country]' => '',
                'User[zipcode]' => '',
                'User[address]' => '',
                'User[address_line]' => '',
                'User[email]' => '',
                'User[password]' => '',
                'User[date_of_birth]' => '',
                'LoginForm[device_name]' => '',
                'LoginForm[device_token]' => '',
                'LoginForm[device_type]' => ''
            ]
        ]
    ];
    ?>
