@extends('layouts.master')


@section('content')
@include('blocks.registration.nav')
<div class="container-fluid">
  <div class="col-sm-8 col-sm-offset-2">
    <div class="well">
        <fieldset>
            <legend class="text-center" style="border-bottom:0;margin-bottom:30px">Let's create your profile together<br><small>Please give us some information about you before continuing</small></legend>
            {!! Form::open(array('url' => route('register.first.save'), 'method' => 'post', 'id' => 'first-registration', 'data-next' => route('register.second'))) !!}
                <div class="row">
                    <div class="col-sm-4 col-xs-4">
                        {{ Form::bsText('firstname', $user->firstname, 'First name', []) }}
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        {{ Form::bsText('middleinitial',  $user->middleinitial, 'MI', []) }}
                    </div>
                    <div class="col-sm-4 col-xs-4">
                        {{ Form::bsText('lastname',  $user->lastname, 'Last name', []) }}
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        {{ Form::bsText('suffix',  $user->middleinitial, 'Suffix (if any)', []) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group bday">
                            <label for="" class="control-label">Birthday</label>
                            
                            <div class="row">
                                <div class="col-sm-6 birthmonth">
                                    {!! Form::selectMonth('birthmonth', $user->getBirth('month'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-sm-3 birthday">
                                    {!! Form::selectRange('birthday', 1, 31, $user->getBirth('day'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-sm-3 birthyear">
                                    {!! Form::selectRange('birthyear', 1998, 1955, $user->getBirth('year'), ['class' => 'form-control']) !!}
                                </div>
                                
                            </div>
                            {{ Form::hidden('birthdate') }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('gender', 'Gender', ['class' => 'control-label']) !!}
                                    {{ Form::select('gender', ['' => '', 'MALE' => 'Male', 'FEMALE' => 'Female'], $user->gender, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('marital_status', 'Marital Status', ['class' => 'control-label']) !!}
                                    {{ Form::select('marital_status', ['' => '', 'SINGLE' => 'Single', 'MARRIED' => 'Married'], $user->marital_status, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        {{ Form::bsText('mobile_number', $user->mobile_number, 'Mobile number', ['placeholder' => 'e.g. 09191234567']) }}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::bsText('email_address', $user->email_address, 'Email address', []) }}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::bsText('skype_account', $user->skype_account, 'Skype account', []) }}
                    </div>
                </div>
                <hr>
                {{ Form::bsText('street_address', $user->street_address, 'Home address', ['placeholder' => 'e.g. #01 Apple St. Brgy Talamban']) }}
                <div class="row">
                    <div class="col-sm-4">
                        {{ Form::bsText('city', $user->city, 'City', ['placeholder' => 'e.g. Cebu City']) }}
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('province', 'Province', ['class' => 'control-label']) !!}
                            
                        </div>
                        <!--{{ Form::bsText('province', $user->province, 'Province', ['placeholder' => 'e.g. Cebu']) }} -->
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
                                <p>Philippines</p>
                           <!-- {{ Form::select('country', 
                                ['' => '', 
                                    'AF' => 'Afghanistan', 
                                    'AX' => 'Åland Islands', 
                                    'AL'=>'Albania', 
                                    'DZ'=>'Algeria', 
                                    'AS'=>'American Samoa', 
                                    'AD' => 'Andorra',
                                    'AO' => 'Angola',
                                    'AI' => 'Anguilla',
                                    'AQ' => 'Antarctica',
                                    'AG' => 'Antigua And Barbuda',
                                    'AR' => 'Argentina',
                                    'AM' => 'Armenia',
                                    'AW' => 'Aruba',
                                    'AU' => 'Australia',
                                    'AT' => 'Austria',
                                    'AZ' => 'Azerbaijan',
                                    'BS' => 'Bahamas',
                                    'BH' => 'Bahrain',
                                    'BD' => 'Bangladesh',
                                    'BB' => 'Barbados',
                                    'BY' => 'Belarus',
                                    'BE' => 'Belgium',
                                    'BZ' => 'Belize',
                                    'BJ' => 'Benin',
                                    'BM' => 'Bermuda',
                                    'BT' => 'Bhutan',
                                    'BO' => 'Bolivia',
                                    'BA' => 'Bosnia And Herzegovina',
                                    'BW' => 'Botswana',
                                    'BV' => 'Bouvet Island',
                                    'BR' => 'Brazil',
                                    'IO' => 'British Indian Ocean Territory',
                                    'BN' => 'Brunei Darussalam',
                                    'BG' => 'Bulgaria',
                                    'BF' => 'Burkina Faso',
                                    'BI' => 'Burundi',
                                    'KH' => 'Cambodia',
                                    'CM' => 'Cameroon',
                                    'CA' => 'Canada',
                                    'CV' => 'Cape Verde',
                                    'KY' => 'Cayman Islands',
                                    'CF' => 'Central African Republic',
                                    'TD' => 'Chad',
                                    'CL' => 'Chile',
                                    'CN' => 'China',
                                    'CX' => 'Christmas Island',
                                    'CC' => 'Cocos (Keeling) Islands',
                                    'CO' => 'Colombia',
                                    'KM' => 'Comoros',
                                    'CG' => 'Congo',
                                    'CD' => 'Congo, Democratic Republic',
                                    'CK' => 'Cook Islands',
                                    'CR' => 'Costa Rica',
                                    'CI' => 'Cote D\'Ivoire',
                                    'HR' => 'Croatia',
                                    'CU' => 'Cuba',
                                    'CY' => 'Cyprus',
                                    'CZ' => 'Czech Republic',
                                    'DK' => 'Denmark',
                                    'DJ' => 'Djibouti',
                                    'DM' => 'Dominica',
                                    'DO' => 'Dominican Republic',
                                    'EC' => 'Ecuador',
                                    'EG' => 'Egypt',
                                    'SV' => 'El Salvador',
                                    'GQ' => 'Equatorial Guinea',
                                    'ER' => 'Eritrea',
                                    'EE' => 'Estonia',
                                    'ET' => 'Ethiopia',
                                    'FK' => 'Falkland Islands (Malvinas)',
                                    'FO' => 'Faroe Islands',
                                    'FJ' => 'Fiji',
                                    'FI' => 'Finland',
                                    'FR' => 'France',
                                    'GF' => 'French Guiana',
                                    'PF' => 'French Polynesia',
                                    'TF' => 'French Southern Territories',
                                    'GA' => 'Gabon',
                                    'GM' => 'Gambia',
                                    'GE' => 'Georgia',
                                    'DE' => 'Germany',
                                    'GH' => 'Ghana',
                                    'GI' => 'Gibraltar',
                                    'GR' => 'Greece',
                                    'GL' => 'Greenland',
                                    'GD' => 'Grenada',
                                    'GP' => 'Guadeloupe',
                                    'GU' => 'Guam',
                                    'GT' => 'Guatemala',
                                    'GG' => 'Guernsey',
                                    'GN' => 'Guinea',
                                    'GW' => 'Guinea-Bissau',
                                    'GY' => 'Guyana',
                                    'HT' => 'Haiti',
                                    'HM' => 'Heard Island & Mcdonald Islands',
                                    'VA' => 'Holy See (Vatican City State)',
                                    'HN' => 'Honduras',
                                    'HK' => 'Hong Kong',
                                    'HU' => 'Hungary',
                                    'IS' => 'Iceland',
                                    'IN' => 'India',
                                    'ID' => 'Indonesia',
                                    'IR' => 'Iran, Islamic Republic Of',
                                    'IQ' => 'Iraq',
                                    'IE' => 'Ireland',
                                    'IM' => 'Isle Of Man',
                                    'IL' => 'Israel',
                                    'IT' => 'Italy',
                                    'JM' => 'Jamaica',
                                    'JP' => 'Japan',
                                    'JE' => 'Jersey',
                                    'JO' => 'Jordan',
                                    'KZ' => 'Kazakhstan',
                                    'KE' => 'Kenya',
                                    'KI' => 'Kiribati',
                                    'KR' => 'Korea',
                                    'KW' => 'Kuwait',
                                    'KG' => 'Kyrgyzstan',
                                    'LA' => 'Lao People\'s Democratic Republic',
                                    'LV' => 'Latvia',
                                    'LB' => 'Lebanon',
                                    'LS' => 'Lesotho',
                                    'LR' => 'Liberia',
                                    'LY' => 'Libyan Arab Jamahiriya',
                                    'LI' => 'Liechtenstein',
                                    'LT' => 'Lithuania',
                                    'LU' => 'Luxembourg',
                                    'MO' => 'Macao',
                                    'MK' => 'Macedonia',
                                    'MG' => 'Madagascar',
                                    'MW' => 'Malawi',
                                    'MY' => 'Malaysia',
                                    'MV' => 'Maldives',
                                    'ML' => 'Mali',
                                    'MT' => 'Malta',
                                    'MH' => 'Marshall Islands',
                                    'MQ' => 'Martinique',
                                    'MR' => 'Mauritania',
                                    'MU' => 'Mauritius',
                                    'YT' => 'Mayotte',
                                    'MX' => 'Mexico',
                                    'FM' => 'Micronesia, Federated States Of',
                                    'MD' => 'Moldova',
                                    'MC' => 'Monaco',
                                    'MN' => 'Mongolia',
                                    'ME' => 'Montenegro',
                                    'MS' => 'Montserrat',
                                    'MA' => 'Morocco',
                                    'MZ' => 'Mozambique',
                                    'MM' => 'Myanmar',
                                    'NA' => 'Namibia',
                                    'NR' => 'Nauru',
                                    'NP' => 'Nepal',
                                    'NL' => 'Netherlands',
                                    'AN' => 'Netherlands Antilles',
                                    'NC' => 'New Caledonia',
                                    'NZ' => 'New Zealand',
                                    'NI' => 'Nicaragua',
                                    'NE' => 'Niger',
                                    'NG' => 'Nigeria',
                                    'NU' => 'Niue',
                                    'NF' => 'Norfolk Island',
                                    'MP' => 'Northern Mariana Islands',
                                    'NO' => 'Norway',
                                    'OM' => 'Oman',
                                    'PK' => 'Pakistan',
                                    'PW' => 'Palau',
                                    'PS' => 'Palestinian Territory, Occupied',
                                    'PA' => 'Panama',
                                    'PG' => 'Papua New Guinea',
                                    'PY' => 'Paraguay',
                                    'PE' => 'Peru',
                                    'PH' => 'Philippines',
                                    'PN' => 'Pitcairn',
                                    'PL' => 'Poland',
                                    'PT' => 'Portugal',
                                    'PR' => 'Puerto Rico',
                                    'QA' => 'Qatar',
                                    'RE' => 'Reunion',
                                    'RO' => 'Romania',
                                    'RU' => 'Russian Federation',
                                    'RW' => 'Rwanda',
                                    'BL' => 'Saint Barthelemy',
                                    'SH' => 'Saint Helena',
                                    'KN' => 'Saint Kitts And Nevis',
                                    'LC' => 'Saint Lucia',
                                    'MF' => 'Saint Martin',
                                    'PM' => 'Saint Pierre And Miquelon',
                                    'VC' => 'Saint Vincent And Grenadines',
                                    'WS' => 'Samoa',
                                    'SM' => 'San Marino',
                                    'ST' => 'Sao Tome And Principe',
                                    'SA' => 'Saudi Arabia',
                                    'SN' => 'Senegal',
                                    'RS' => 'Serbia',
                                    'SC' => 'Seychelles',
                                    'SL' => 'Sierra Leone',
                                    'SG' => 'Singapore',
                                    'SK' => 'Slovakia',
                                    'SI' => 'Slovenia',
                                    'SB' => 'Solomon Islands',
                                    'SO' => 'Somalia',
                                    'ZA' => 'South Africa',
                                    'GS' => 'South Georgia And Sandwich Isl.',
                                    'ES' => 'Spain',
                                    'LK' => 'Sri Lanka',
                                    'SD' => 'Sudan',
                                    'SR' => 'Suriname',
                                    'SJ' => 'Svalbard And Jan Mayen',
                                    'SZ' => 'Swaziland',
                                    'SE' => 'Sweden',
                                    'CH' => 'Switzerland',
                                    'SY' => 'Syrian Arab Republic',
                                    'TW' => 'Taiwan',
                                    'TJ' => 'Tajikistan',
                                    'TZ' => 'Tanzania',
                                    'TH' => 'Thailand',
                                    'TL' => 'Timor-Leste',
                                    'TG' => 'Togo',
                                    'TK' => 'Tokelau',
                                    'TO' => 'Tonga',
                                    'TT' => 'Trinidad And Tobago',
                                    'TN' => 'Tunisia',
                                    'TR' => 'Turkey',
                                    'TM' => 'Turkmenistan',
                                    'TC' => 'Turks And Caicos Islands',
                                    'TV' => 'Tuvalu',
                                    'UG' => 'Uganda',
                                    'UA' => 'Ukraine',
                                    'AE' => 'United Arab Emirates',
                                    'GB' => 'United Kingdom',
                                    'US' => 'United States',
                                    'UM' => 'United States Outlying Islands',
                                    'UY' => 'Uruguay',
                                    'UZ' => 'Uzbekistan',
                                    'VU' => 'Vanuatu',
                                    'VE' => 'Venezuela',
                                    'VN' => 'Viet Nam',
                                    'VG' => 'Virgin Islands, British',
                                    'VI' => 'Virgin Islands, U.S.',
                                    'WF' => 'Wallis And Futuna',
                                    'EH' => 'Western Sahara',
                                    'YE' => 'Yemen',
                                    'ZM' => 'Zambia',
                                    'ZW' => 'Zimbabwe'
                                ], $user->marital_status, ['class' => 'form-control']) }} -->
                            <!--{{ Form::bsText('country', $user->country, 'Country') }} -->
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::bsPassword('password', 'Password') }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsPassword('password_confirmation', 'Password confirmation') }}
                    </div>
                </div>
                <button type="submit" class="btn btn-success pull-right">Save</button>
            {!! Form::close() !!}
        </fieldset>
    </div>
  </div>
</div>
@endsection