<?php

declare(strict_types=1);

return [
    'accepted'             => ':Attribute mesti diterima pakai.',
    'accepted_if'          => ':Attribute mesti diterima pakai sekiranya :other adalah :value.',
    'active_url'           => ':Attribute bukan URL yang sah.',
    'after'                => ':Attribute mesti tarikh selepas :date.',
    'after_or_equal'       => ':Attribute mesti tarikh selepas atau sama dengan :date.',
    'alpha'                => ':Attribute hanya boleh mengandungi huruf.',
    'alpha_dash'           => ':Attribute boleh mengandungi huruf, nombor, dan sengkang.',
    'alpha_num'            => ':Attribute boleh mengandungi huruf dan nombor.',
    'array'                => ':Attribute mesti jujukan.',
    'ascii'                => ':Attribute mesti hanya mengandungi aksara dan simbol alfanumerik bait tunggal.',
    'before'               => ':Attribute mesti tarikh sebelum :date.',
    'before_or_equal'      => ':Attribute mesti tarikh sebelum atau sama dengan :date.',
    'between'              => [
        'array'   => ':Attribute mesti mengandungi antara :min dan :max perkara.',
        'file'    => ':Attribute mesti mengandungi antara :min dan :max kilobait.',
        'numeric' => ':Attribute mesti mengandungi antara :min dan :max.',
        'string'  => ':Attribute mesti mengandungi antara :min dan :max aksara.',
    ],
    'boolean'              => ':Attribute mesti benar atau salah.',
    'can'                  => 'Medan :attribute mengandungi nilai yang tidak dibenarkan.',
    'confirmed'            => ':Attribute pengesahan yang tidak sepadan.',
    'current_password'     => 'Katalaluan anda adalah salah.',
    'date'                 => ':Attribute bukan tarikh yang sah.',
    'date_equals'          => ':Attribute mesti tarikh sama dengan :date.',
    'date_format'          => ':Attribute tidak mengikut format :format.',
    'decimal'              => ':Attribute mesti mempunyai :decimal tempat perpuluhan.',
    'declined'             => ':Attribute mesti ditolak.',
    'declined_if'          => ':Attribute mesti ditolak apabila :other adalah :value.',
    'different'            => ':Attribute dan :other mesti berlainan.',
    'digits'               => ':Attribute mesti :digits.',
    'digits_between'       => ':Attribute mesti mengandungi antara :min dan :max digits.',
    'dimensions'           => ':Attribute tidak sah',
    'distinct'             => ':Attribute adalah nilai yang berulang',
    'doesnt_end_with'      => ':Attribute mungkin tidak berakhir dengan salah satu daripada yang berikut: :values.',
    'doesnt_start_with'    => ':Attribute mungkin tidak bermula dengan salah satu daripada yang berikut: :values.',
    'email'                => ':Attribute tidak sah.',
    'ends_with'            => ':Attribute mesti berakhir dengan salah satu dari: :values.',
    'enum'                 => ':Attribute yang dipilih adalah tidak sah.',
    'exists'               => ':Attribute tidak sah.',
    'extensions'           => 'Medan :attribute mesti mempunyai salah satu daripada sambungan berikut: :values.',
    'file'                 => ':Attribute mesti fail yang sah.',
    'filled'               => ':Attribute diperlukan.',
    'gt'                   => [
        'array'   => ':Attribute mesti mengandungi lebih daripada :value perkara.',
        'file'    => ':Attribute mesti melebihi :value kilobait.',
        'numeric' => ':Attribute mesti melebihi :value.',
        'string'  => ':Attribute mesti melebihi :value aksara.',
    ],
    'gte'                  => [
        'array'   => ':Attribute mesti mengandungi :value perkara atau lebih.',
        'file'    => ':Attribute mesti melebihi atau bersamaan :value kilobait.',
        'numeric' => ':Attribute mesti melebihi atau bersamaan :value.',
        'string'  => ':Attribute mesti melebihi atau bersamaan :value aksara.',
    ],
    'hex_color'            => 'Medan :attribute mestilah warna perenambelasan yang sah.',
    'image'                => ':Attribute mesti imej.',
    'in'                   => ':Attribute tidak sah.',
    'in_array'             => ':Attribute tidak wujud dalam :other.',
    'integer'              => ':Attribute mesti integer.',
    'ip'                   => ':Attribute mesti alamat IP yang sah.',
    'ipv4'                 => ':Attribute mesti alamat IPv4 yang sah.',
    'ipv6'                 => ':Attribute mesti alamat IPv6 yang sah',
    'json'                 => ':Attribute mesti JSON yang sah.',
    'lowercase'            => ':Attribute mestilah huruf kecil.',
    'lt'                   => [
        'array'   => ':Attribute mesti mengandungi kurang daripada :value perkara.',
        'file'    => ':Attribute mesti kurang daripada :value kilobait.',
        'numeric' => ':Attribute mesti kurang daripada :value.',
        'string'  => ':Attribute mesti kurang daripada :value aksara.',
    ],
    'lte'                  => [
        'array'   => ':Attribute mesti mengandungi kurang daripada atau bersamaan dengan :value perkara.',
        'file'    => ':Attribute mesti kurang daripada atau bersamaan dengan :value kilobait.',
        'numeric' => ':Attribute mesti kurang daripada atau bersamaan dengan :value.',
        'string'  => ':Attribute mesti kurang daripada atau bersamaan dengan :value aksara.',
    ],
    'mac_address'          => ':Attribute mestilah alamat MAC yang sah.',
    'max'                  => [
        'array'   => 'Jumlah :attribute mesti tidak melebihi :max perkara.',
        'file'    => 'Jumlah :attribute mesti tidak melebihi :max kilobait.',
        'numeric' => 'Jumlah :attribute mesti tidak melebihi :max.',
        'string'  => 'Jumlah :attribute mesti tidak melebihi :max aksara.',
    ],
    'max_digits'           => ':Attribute tidak boleh mempunyai lebih daripada :max digit.',
    'mimes'                => ':Attribute mesti fail type: :values.',
    'mimetypes'            => ':Attribute mesti fail type: :values.',
    'min'                  => [
        'array'   => 'Jumlah :attribute mesti sekurang-kurangnya :min perkara.',
        'file'    => 'Jumlah :attribute mesti sekurang-kurangnya :min kilobait.',
        'numeric' => 'Jumlah :attribute mesti sekurang-kurangnya :min.',
        'string'  => 'Jumlah :attribute mesti sekurang-kurangnya :min aksara.',
    ],
    'min_digits'           => ':Attribute mesti mempunyai sekurang-kurangnya :min digit.',
    'missing'              => 'Medan :attribute mesti tiada.',
    'missing_if'           => 'Medan :attribute mesti tiada apabila :other ialah :value.',
    'missing_unless'       => 'Medan :attribute mesti tiada melainkan :other ialah :value.',
    'missing_with'         => 'Medan :attribute mesti tiada apabila :values hadir.',
    'missing_with_all'     => 'Medan :attribute mesti tiada apabila :values hadir.',
    'multiple_of'          => ':Attribute mesti gandaan :value',
    'not_in'               => ':Attribute tidak sah.',
    'not_regex'            => 'Format :attribute adalah tidak sah.',
    'numeric'              => ':Attribute mesti nombor.',
    'password'             => [
        'letters'       => ':Attribute mesti mengandungi sekurang-kurangnya satu huruf.',
        'mixed'         => ':Attribute mesti mengandungi sekurang-kurangnya satu huruf besar dan satu huruf kecil.',
        'numbers'       => ':Attribute mesti mengandungi sekurang-kurangnya satu nombor.',
        'symbols'       => ':Attribute mesti mengandungi sekurang-kurangnya satu simbol.',
        'uncompromised' => ':Attribute yang diberikan telah muncul dalam kebocoran data. Sila pilih :attribute yang berbeza.',
    ],
    'present'              => 'Ruangan :attribute mesti wujud.',
    'present_if'           => 'Medan :attribute mesti ada apabila :other ialah :value.',
    'present_unless'       => 'Medan :attribute mesti ada kecuali :other ialah :value.',
    'present_with'         => 'Medan :attribute mesti ada apabila :values hadir.',
    'present_with_all'     => 'Medan :attribute mesti ada apabila :values ada.',
    'prohibited'           => 'Ruangan :attribute adalah dilarang.',
    'prohibited_if'        => 'Ruangan :attribute adalah dilarang apabila :other adalah :value.',
    'prohibited_unless'    => 'Ruangan :attribute adalah dilarang kecuali :other adalah di :values.',
    'prohibits'            => 'Medan :attribute melarang :other daripada hadir.',
    'regex'                => 'Format :attribute tidak sah.',
    'required'             => 'Ruangan :attribute diperlukan.',
    'required_array_keys'  => 'Medan :attribute mesti mengandungi entri untuk: :values.',
    'required_if'          => 'Ruangan :attribute diperlukan bila :other sama dengan :value.',
    'required_if_accepted' => 'Medan :attribute diperlukan apabila :other diterima.',
    'required_unless'      => 'Ruangan :attribute diperlukan sekiranya :other ada dalam :values.',
    'required_with'        => 'Ruangan :attribute diperlukan bila :values wujud.',
    'required_with_all'    => 'Ruangan :attribute diperlukan bila :values wujud.',
    'required_without'     => 'Ruangan :attribute diperlukan bila :values tidak wujud.',
    'required_without_all' => 'Ruangan :attribute diperlukan bila kesemua :values wujud.',
    'same'                 => 'Ruangan :attribute dan :other mesti sepadan.',
    'size'                 => [
        'array'   => 'Saiz :attribute mesti mengandungi :size perkara.',
        'file'    => 'Saiz :attribute mesti :size kilobait.',
        'numeric' => 'Saiz :attribute mesti :size.',
        'string'  => 'Saiz :attribute mesti :size aksara.',
    ],
    'starts_with'          => ':Attribute mesti bermula dengan salah satu dari: :values',
    'string'               => ':Attribute mesti aksara.',
    'timezone'             => ':Attribute mesti zon masa yang sah.',
    'ulid'                 => ':Attribute mestilah ULID yang sah.',
    'unique'               => ':Attribute telah wujud.',
    'uploaded'             => ':Attribute gagal dimuat naik.',
    'uppercase'            => ':Attribute mestilah huruf besar.',
    'url'                  => ':Attribute format tidak sah.',
    'uuid'                 => ':Attribute mesti UUID yang sah.',
    'attributes'           => [
        'address'                  => 'alamat',
        'affiliate_url'            => 'URL ahli gabungan',
        'age'                      => 'umur',
        'amount'                   => 'jumlah',
        'announcement'             => 'pengumuman',
        'area'                     => 'kawasan',
        'audience_prize'           => 'hadiah penonton',
        'available'                => 'tersedia',
        'birthday'                 => 'hari jadi',
        'body'                     => 'badan',
        'city'                     => 'bandar',
        'compilation'              => 'kompilasi',
        'concept'                  => 'konsep',
        'conditions'               => 'syarat',
        'content'                  => 'kandungan',
        'country'                  => 'negara',
        'cover'                    => 'penutup',
        'created_at'               => 'dicipta di',
        'creator'                  => 'pencipta',
        'currency'                 => 'mata wang',
        'current_password'         => 'kata laluan semasa',
        'customer'                 => 'pelanggan',
        'date'                     => 'Tarikh',
        'date_of_birth'            => 'tarikh lahir',
        'dates'                    => 'tarikh',
        'day'                      => 'hari',
        'deleted_at'               => 'dipadamkan pada',
        'description'              => 'penerangan',
        'display_type'             => 'jenis paparan',
        'district'                 => 'daerah',
        'duration'                 => 'tempoh masa',
        'email'                    => 'emel',
        'excerpt'                  => 'petikan',
        'filter'                   => 'penapis',
        'finished_at'              => 'selesai pada',
        'first_name'               => 'nama pertama',
        'gender'                   => 'jantina',
        'grand_prize'              => 'hadiah utama',
        'group'                    => 'kumpulan',
        'hour'                     => 'jam',
        'image'                    => 'imej',
        'image_desktop'            => 'imej desktop',
        'image_main'               => 'imej utama',
        'image_mobile'             => 'imej mudah alih',
        'images'                   => 'imej',
        'is_audience_winner'       => 'adalah pemenang penonton',
        'is_hidden'                => 'tersembunyi',
        'is_subscribed'            => 'dilanggan',
        'is_visible'               => 'kelihatan',
        'is_winner'                => 'adalah pemenang',
        'items'                    => 'barang',
        'key'                      => 'kunci',
        'last_name'                => 'nama terakhir',
        'lesson'                   => 'pelajaran',
        'line_address_1'           => 'alamat talian 1',
        'line_address_2'           => 'alamat talian 2',
        'login'                    => 'log masuk',
        'message'                  => 'mesej',
        'middle_name'              => 'nama tengah',
        'minute'                   => 'minit',
        'mobile'                   => 'mudah alih',
        'month'                    => 'bulan',
        'name'                     => 'nama',
        'national_code'            => 'kod kebangsaan',
        'number'                   => 'nombor',
        'password'                 => 'kata laluan',
        'password_confirmation'    => 'pengesahan kata laluan',
        'phone'                    => 'telefon',
        'photo'                    => 'foto',
        'portfolio'                => 'portfolio',
        'postal_code'              => 'Poskod',
        'preview'                  => 'pratonton',
        'price'                    => 'harga',
        'product_id'               => 'ID produk',
        'product_uid'              => 'UID produk',
        'product_uuid'             => 'produk UUID',
        'promo_code'               => 'kod promosi',
        'province'                 => 'wilayah',
        'quantity'                 => 'kuantiti',
        'reason'                   => 'sebab',
        'recaptcha_response_field' => 'medan respons recaptcha',
        'referee'                  => 'pengadil',
        'referees'                 => 'pengadil',
        'reject_reason'            => 'menolak alasan',
        'remember'                 => 'ingat',
        'restored_at'              => 'dipulihkan pada',
        'result_text_under_image'  => 'teks hasil di bawah imej',
        'role'                     => 'peranan',
        'rule'                     => 'peraturan',
        'rules'                    => 'peraturan',
        'second'                   => 'kedua',
        'sex'                      => 'seks',
        'shipment'                 => 'penghantaran',
        'short_text'               => 'teks pendek',
        'size'                     => 'saiz',
        'skills'                   => 'kemahiran',
        'slug'                     => 'slug',
        'specialization'           => 'pengkhususan',
        'started_at'               => 'bermula pada',
        'state'                    => 'negeri',
        'status'                   => 'status',
        'street'                   => 'jalan',
        'student'                  => 'pelajar',
        'subject'                  => 'subjek',
        'tag'                      => 'tag',
        'tags'                     => 'tag',
        'teacher'                  => 'cikgu',
        'terms'                    => 'syarat',
        'test_description'         => 'penerangan ujian',
        'test_locale'              => 'tempat ujian',
        'test_name'                => 'nama ujian',
        'text'                     => 'teks',
        'time'                     => 'masa',
        'title'                    => 'tajuk',
        'type'                     => 'taip',
        'updated_at'               => 'dikemas kini pada',
        'user'                     => 'pengguna',
        'username'                 => 'nama pengguna',
        'value'                    => 'nilai',
        'year'                     => 'tahun',
    ],
];