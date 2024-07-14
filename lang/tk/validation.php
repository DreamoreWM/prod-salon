<?php

declare(strict_types=1);

return [
    'accepted'             => ':Attribute kabul edilmelidir.',
    'accepted_if'          => ':Other-i :value bolanda :attribute-i kabul etmeli.',
    'active_url'           => ':Attribute dogry URL bolmalydyr.',
    'after'                => ':Attribute şundan has köne sene bolmalydyr :date.',
    'after_or_equal'       => ':Attribute-den soň bir sene bolmaly ýa-da :date-e deň bolmaly.',
    'alpha'                => ':Attribute dine harplardan durmalydyr.',
    'alpha_dash'           => ':Attribute dine harplardan, sanlardan we tirelerden durmalydyr.',
    'alpha_num'            => ':Attribute dine harplardan we sanlardan durmalydyr.',
    'array'                => ':Attribute ýygyndy bolmalydyr.',
    'ascii'                => ':Attribute-de diňe bir baýtly harp sanlary we nyşanlary bolmaly.',
    'before'               => ':Attribute şundan has irki sene bolmalydyr :date.',
    'before_or_equal'      => ':Attribute-den öň bir sene bolmaly ýa-da :date-e deň bolmaly.',
    'between'              => [
        'array'   => ':Attribute :min - :max arasynda madda eýe bolmalydyr.',
        'file'    => ':Attribute :min - :max kilobaýt arasynda bolmalydyr.',
        'numeric' => ':Attribute :min - :max arasynda bolmalydyr.',
        'string'  => ':Attribute :min - :max harplar arasynda bolmalydyr.',
    ],
    'boolean'              => ':Attribute diňe dogry ýada ýalňyş bolmalydyr.',
    'can'                  => ':Attribute meýdanda birugsat baha bar.',
    'confirmed'            => ':Attribute tassyklamasy deň däl.',
    'current_password'     => 'Parol nädogry',
    'date'                 => ':Attribute dogry sene bolmalydyr.',
    'date_equals'          => ':Attribute-i :date-e deň bolan sene bolmaly.',
    'date_format'          => ':Attribute :format formatyna deň däl.',
    'decimal'              => ':Attribute-de :decimal onluk ýer bolmaly.',
    'declined'             => ':Attribute-den ýüz öwürmeli.',
    'declined_if'          => ':Other :value bolanda :attribute-den ýüz öwürmeli.',
    'different'            => ':Attribute bilen :other birbirinden tapawutly bolmalydyr.',
    'digits'               => ':Attribute :digits san bolmalydyr.',
    'digits_between'       => ':Attribute :min bilen :max arasynda san bolmalydyr.',
    'dimensions'           => ':Attribute-de nädogry şekil ölçegleri bar.',
    'distinct'             => ':Attribute meýdanyň dublikat bahasy bar.',
    'doesnt_end_with'      => ':Attribute aşakdakylaryň biri bilen gutarman biler: :values.',
    'doesnt_start_with'    => ':Attribute aşakdakylardan biri bilen başlamazlygy mümkin: :values.',
    'email'                => ':Attribute formaty ýalňyş.',
    'ends_with'            => ':Attribute aşakdakylaryň biri bilen gutarmaly: :values.',
    'enum'                 => 'Saýlanan :attribute nädogry.',
    'exists'               => 'Saýlanan :attribute ýalňyş.',
    'extensions'           => ':attribute meýdançada aşakdaky giňeltmeleriň biri bolmaly: :values.',
    'file'                 => ':Attribute faýl bolmaly.',
    'filled'               => ':Attribute meýdany zerur.',
    'gt'                   => [
        'array'   => ':Attribute-de :value-den gowrak zat bolmaly.',
        'file'    => ':Attribute :value kilobaýtdan uly bolmaly.',
        'numeric' => ':Attribute-den :value-den uly bolmaly.',
        'string'  => ':Attribute simwoldan uly bolmaly.',
    ],
    'gte'                  => [
        'array'   => ':Attribute-de :value element ýa-da ondan köp zat bolmaly.',
        'file'    => ':Attribute :value kilobaýtdan uly ýa-da deň bolmaly.',
        'numeric' => ':Attribute :value-den uly ýa-da deň bolmaly.',
        'string'  => ':Attribute :value simwoldan uly ýa-da deň bolmaly.',
    ],
    'hex_color'            => ':attribute meýdan dogry altyburç reňk bolmaly.',
    'image'                => ':Attribute surat bolmalydyr.',
    'in'                   => ':Attribute mukdary ýalňyş.',
    'in_array'             => ':Attribute meýdan :other-de ýok.',
    'integer'              => ':Attribute san bolmalydyr.',
    'ip'                   => ':Attribute dogry IP adres bolmalydyr.',
    'ipv4'                 => ':Attribute dogry IPv4 salgy bolmaly.',
    'ipv6'                 => ':Attribute dogry IPv6 salgy bolmaly.',
    'json'                 => ':Attribute dogry JSON setiri bolmaly.',
    'lowercase'            => ':Attribute kiçi harp bolmaly',
    'lt'                   => [
        'array'   => ':Attribute-de :value-den az zat bolmaly.',
        'file'    => ':Attribute :value kilobaýtdan az bolmalydyr.',
        'numeric' => ':Attribute-den :value-den az bolmaly.',
        'string'  => ':Attribute simwoldan :value simwoldan az bolmaly.',
    ],
    'lte'                  => [
        'array'   => ':Attribute-de :value-den köp zat bolmaly däldir.',
        'file'    => ':Attribute :value kilobaýtdan az ýa-da deň bolmaly.',
        'numeric' => ':Attribute-den :value-den az ýa-da deň bolmaly.',
        'string'  => ':Attribute :value simwoldan az ýa-da deň bolmaly.',
    ],
    'mac_address'          => ':Attribute dogry MAC salgysy bolmaly.',
    'max'                  => [
        'array'   => ':Attribute iň az :max maddadan ybarat bolmalydyr.',
        'file'    => ':Attribute :max kilobaýtdan kiçi bolmalydyr.',
        'numeric' => ':Attribute :max den kiçi bolmalydyr.',
        'string'  => ':Attribute :max harpdan kiçi bolmalydyr.',
    ],
    'max_digits'           => ':Attribute-de :max sandan köp bolmaly däldir.',
    'mimes'                => ':Attribute faýlň formaty :values bolmalydyr.',
    'mimetypes'            => ':Attribute faýlň formaty :values bolmalydyr.',
    'min'                  => [
        'array'   => ':Attribute iň az :min harpdan bolmalydyr.',
        'file'    => ':Attribute mukdary :min kilobaýtdan köp bolmalydyr.',
        'numeric' => ':Attribute mukdary :min dan köp bolmalydyr.',
        'string'  => ':Attribute mukdary :min harpdan köp bolmalydyr.',
    ],
    'min_digits'           => ':Attribute-de azyndan :min san bolmaly.',
    'missing'              => ':Attribute meýdan ýok bolmaly.',
    'missing_if'           => ':Other meýdan :value bolanda :attribute meýdan ýok bolmaly.',
    'missing_unless'       => ':Other meýdan :value bolmasa, :attribute meýdan ýok bolmaly.',
    'missing_with'         => ':Values meýdançada :attribute meýdan ýok bolmaly.',
    'missing_with_all'     => ':Values meýdançada :attribute meýdan ýok bolmaly.',
    'multiple_of'          => ':Attribute :value-den köp bolmaly.',
    'not_in'               => 'Saýlanan :attribute geçersiz.',
    'not_regex'            => ':Attribute format nädogry.',
    'numeric'              => ':Attribute san bolmalydyr.',
    'password'             => [
        'letters'       => ':Attribute-de azyndan bir harp bolmaly.',
        'mixed'         => ':Attribute-de azyndan bir baş harp we bir kiçi harp bolmaly.',
        'numbers'       => ':Attribute-de azyndan bir san bolmaly.',
        'symbols'       => ':Attribute-de azyndan bir nyşan bolmaly.',
        'uncompromised' => 'Berlen :attribute maglumat syzdyrylyşynda peýda boldy. Başga :attribute saýlaň.',
    ],
    'present'              => ':Attribute meýdan bolmaly.',
    'present_if'           => ':other meýdan :value bolanda :attribute meýdan bolmaly.',
    'present_unless'       => ':other meýdan :value bolmasa, :attribute meýdan bolmaly.',
    'present_with'         => ':values meýdan bolanda :attribute meýdan bolmaly.',
    'present_with_all'     => ':values meýdança :values meýdança bar bolmaly.',
    'prohibited'           => ':Attribute meýdan gadagan.',
    'prohibited_if'        => ':Other meýdan :value bolanda :attribute meýdan gadagan.',
    'prohibited_unless'    => ':Other meýdança :values bolmasa, :attribute meýdan gadagan.',
    'prohibits'            => ':Attribute meýdança :other adamyň gatnaşmagyny gadagan edýär.',
    'regex'                => ':Attribute formaty ýalňyş.',
    'required'             => ':Attribute meýdany zerur.',
    'required_array_keys'  => ':Attribute meýdançada: :values üçin ýazgylar bolmaly.',
    'required_if'          => ':Attribute meýdany, :other :value hümmetine eýe bolanynda zerurdyr.',
    'required_if_accepted' => ':Other kabul edilende :attribute meýdan talap edilýär.',
    'required_unless'      => ':Other meýdan :values-de bolmasa, :attribute meýdan talap edilýär.',
    'required_with'        => ':Attribute meýdany :values bar bolanda zerurdyr.',
    'required_with_all'    => ':Attribute meýdany haýsyda bolsa bir :values bar bolanda zerurdyr.',
    'required_without'     => ':Attribute meýdany :values ýok bolanda zerurdyr.',
    'required_without_all' => ':Attribute meýdany :values dan haýsyda bolsa biri ýok bolanda zerurdyr.',
    'same'                 => ':Attribute bilen :other deň bolmalydyr.',
    'size'                 => [
        'array'   => ':Attribute :size madda eýe bolmalydyr.',
        'file'    => ':Attribute :size kilobaýt bolmalydyr.',
        'numeric' => ':Attribute :size sandan ybarat bolmalydyr.',
        'string'  => ':Attribute :size harp bolmalydyr.',
    ],
    'starts_with'          => ':attribute-lary aşakdakylardan biri bilen başlamaly: :values.',
    'string'               => ':Attribute setir bolmaly.',
    'timezone'             => ':Attribute dogry zolak bolmalydyr.',
    'ulid'                 => ':Attribute-i dogry ULID bolmaly.',
    'unique'               => ':Attribute önden hasaba alyndy.',
    'uploaded'             => ':Attribute adam ýükläp bilmedi.',
    'uppercase'            => ':Attribute baş harp bolmaly.',
    'url'                  => ':Attribute formaty ýalňyş.',
    'uuid'                 => ':Attribute-i dogry UUID bolmaly.',
    'attributes'           => [
        'address'                  => 'salgysy',
        'affiliate_url'            => 'şahamça URL',
        'age'                      => 'ýaşy',
        'amount'                   => 'mukdary',
        'announcement'             => 'bildiriş',
        'area'                     => 'meýdany',
        'audience_prize'           => 'tomaşaçylaryň baýragy',
        'available'                => 'elýeterli',
        'birthday'                 => 'doglan güni',
        'body'                     => 'beden',
        'city'                     => 'şäher',
        'compilation'              => 'düzmek',
        'concept'                  => 'düşünjesi',
        'conditions'               => 'şertleri',
        'content'                  => 'mazmuny',
        'country'                  => 'ýurt',
        'cover'                    => 'gapagy',
        'created_at'               => 'döredildi',
        'creator'                  => 'dörediji',
        'currency'                 => 'walýuta',
        'current_password'         => 'Hazirki parolynyz',
        'customer'                 => 'Müşderi',
        'date'                     => 'senesi',
        'date_of_birth'            => 'doglan gün',
        'dates'                    => 'seneleri',
        'day'                      => 'gün',
        'deleted_at'               => 'öçürildi',
        'description'              => 'beýany',
        'display_type'             => 'görkeziş görnüşi',
        'district'                 => 'etrap',
        'duration'                 => 'dowamlylygy',
        'email'                    => 'e-poçta iberiň',
        'excerpt'                  => 'bölek',
        'filter'                   => 'süzgüç',
        'finished_at'              => 'gutardy',
        'first_name'               => 'ady',
        'gender'                   => 'jyns',
        'grand_prize'              => 'baş baýrak',
        'group'                    => 'topary',
        'hour'                     => 'sagat',
        'image'                    => 'şekil',
        'image_desktop'            => 'iş stoly',
        'image_main'               => 'esasy surat',
        'image_mobile'             => 'ykjam şekil',
        'images'                   => 'suratlar',
        'is_audience_winner'       => 'tomaşaçylaryň ýeňijisi',
        'is_hidden'                => 'gizlenendir',
        'is_subscribed'            => 'abuna ýazyldy',
        'is_visible'               => 'görünýär',
        'is_winner'                => 'ýeňiji boldy',
        'items'                    => 'elementler',
        'key'                      => 'açary',
        'last_name'                => 'familiýa',
        'lesson'                   => 'sapak',
        'line_address_1'           => 'setir salgysy 1',
        'line_address_2'           => 'setir salgysy 2',
        'login'                    => 'giriş',
        'message'                  => 'habar',
        'middle_name'              => 'orta ady',
        'minute'                   => 'minut',
        'mobile'                   => 'ykjam',
        'month'                    => 'aý',
        'name'                     => 'ady',
        'national_code'            => 'milli kod',
        'number'                   => 'sany',
        'password'                 => 'parol',
        'password_confirmation'    => 'paroly tassyklamak',
        'phone'                    => 'telefon',
        'photo'                    => 'surat',
        'portfolio'                => 'bukjasy',
        'postal_code'              => 'poçta kody',
        'preview'                  => 'deslapky syn',
        'price'                    => 'bahasy',
        'product_id'               => 'önüm belgisi',
        'product_uid'              => 'önüm UID',
        'product_uuid'             => 'önüm UUID',
        'promo_code'               => 'promo kody',
        'province'                 => 'welaýaty',
        'quantity'                 => 'mukdary',
        'reason'                   => 'sebäp',
        'recaptcha_response_field' => 'jogap meýdany',
        'referee'                  => 'emin',
        'referees'                 => 'eminler',
        'reject_reason'            => 'sebäbini ret et',
        'remember'                 => 'ýadyňyzda saklaň',
        'restored_at'              => 'dikeldildi',
        'result_text_under_image'  => 'netijäniň teksti',
        'role'                     => 'roly',
        'rule'                     => 'düzgün',
        'rules'                    => 'düzgünleri',
        'second'                   => 'ikinji',
        'sex'                      => 'jyns',
        'shipment'                 => 'ibermek',
        'short_text'               => 'gysga tekst',
        'size'                     => 'ululygy',
        'skills'                   => 'başarnyklary',
        'slug'                     => 'slug',
        'specialization'           => 'ýöriteleşdirme',
        'started_at'               => 'başlady',
        'state'                    => 'ýagdaýy',
        'status'                   => 'ýagdaýy',
        'street'                   => 'köçe',
        'student'                  => 'okuwçy',
        'subject'                  => 'mowzuk',
        'tag'                      => 'belligi',
        'tags'                     => 'bellikleri',
        'teacher'                  => 'mugallym',
        'terms'                    => 'şertleri',
        'test_description'         => 'synag beýany',
        'test_locale'              => 'synag sebiti',
        'test_name'                => 'synag ady',
        'text'                     => 'tekst',
        'time'                     => 'wagt',
        'title'                    => 'ady',
        'type'                     => 'görnüşi',
        'updated_at'               => 'täzelendi',
        'user'                     => 'ulanyjy',
        'username'                 => 'ulanyjy ady',
        'value'                    => 'bahasy',
        'year'                     => 'ýyl',
    ],
];