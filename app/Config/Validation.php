<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    // Rules for user login.
    public $login = [
        'username' => [
            'field' => 'username',
            'label' => 'Email atau username',
            'rules' => 'trim|required',
            'errors' => array (
                'required' => 'Anda belum menginput email atau username!',
            )
        ],
        'password' => [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required',
            'errors' => array (
                'required' => 'Anda belum menginput password!',
            )
        ],
    ];

    // Rules for inserting user data.
    public $userAdd = [
        'username' => [
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|alpha_numeric|min_length[6]|max_length[30]|is_unique[user.username]',
            'errors' => array (
                'required' => 'Username wajib diinput!',
                'alpha_numeric' => 'Username hanya terdiri dari huruf dan angka!',
                'min_length' => 'Panjang username minimal 6 karakter!',
                'max_length' => 'Panjang username maksimal 30 karakter!',
                'is_unique' => 'Username ini sudah diambil!',
            ),
        ],
        'password' => [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[8]|max_length[50]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/]',
            'errors' => array (
                'required' => 'Password wajib diinput!',
                'min_length' => 'Panjang password minimal 8 karakter!',
                'max_length' => 'Panjang password maksimal 50 karakter!',
                'regex_match' => 'Mohon input password yang valid!'
            ),
        ],
        'repeat_password' => [
            'field' => 'repeat_password',
            'rules' => 'trim|required|matches[password]',
            'errors' => array (
                'required' => 'Password harus diinput kembali pada kolom konfimasi password!',
                'matches' => 'Password tidak cocok!',
            ),
        ],
        'name' => [
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'trim|required|max_length[100]',
            'errors' => array (
                'required' => 'Nama wajib diinput!',
                'max_length' => 'Panjang nama maksimal 100 karakter!',
            ),
        ],
        'email' => [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|max_length[100]',
            'errors' => array (
                'required' => 'Email wajib diinput!',
                'valid_email' => 'Mohon input email yang valid!',
                'max_length' => 'Panjang email maksimal 100 karakter!',
            ),
        ],
        'birthdate' => [
            'field' => 'birthdate',
            'label' => 'Tanggal Lahir',
            'rules' => 'trim|required|valid_date',
            'errors' => array (
                'required' => 'Tanggal lahir wajib diinput!',
                'valid_date' => 'Mohon input tanggal lahir yang valid!'
            ),
        ],
        'address' => [
            'field' => 'address',
            'label' => 'Alamat',
            'rules' => 'trim|required|max_length[255]',
            'errors' => array (
                'required' => 'Alamat wajib diinput!',
                'max_length' => 'Panjang alamat maksimal 255 karakter!',
            ),
        ],
        'phone_number' => [
            'field' => 'phone_number',
            'label' => 'Nomor Telepon',
            'rules' => 'trim|required|max_length[15]|regex_match[^\d{4}-\d{4}-\d{4}$]',
            'error' => array (
                'required' => 'Nomor telepon wajib diinput!',
                'max_length' => 'Panjang nomor telepon maksimal 15 karakter!',
                'regex_match' => 'Mohon input nomor telepon yang valid!',
            ),
        ],
        'avatar' => [
            'field' => 'avatar',
            'label' => 'Avatar',
            'rules' => 'uploaded[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/gif]|max_size[avatar, 1024]',
            'errors' => array (
                'uploaded' => 'Avatar wajib diupload!',
                'mime_in' => 'Mohon input file yang valid untuk avatar!',
                'max_size' => 'Ukuran file avatar maksimal 1MB!',
            ),
        ],
        'role' => [
            'rules' => 'trim|required|max_length[6]',
        ],
        'status' => [
            'rules' => 'trim|required|max_length[10]',
        ]
    ];

    // Rules for updating user data.
    public $userEdit = [
        'id' => [
            'rules' => 'trim|required|max_length[11]|is_natural',
        ],
        'username' => [
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|alpha_numeric|min_length[6]|max_length[30]|is_unique[user.username,id,{id}]',
            'errors' => array (
                'required' => 'Username wajib diinput!',
                'alpha_numeric' => 'Username hanya terdiri dari huruf dan angka!',
                'min_length' => 'Panjang username minimal 6 karakter!',
                'max_length' => 'Panjang username maksimal 30 karakter!',
                'is_unique' => 'Username ini sudah diambil!',
            ),
        ],
        'name' => [
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'trim|required|max_length[100]',
            'errors' => array (
                'required' => 'Nama wajib diinput!',
                'max_length' => 'Panjang nama maksimal 100 karakter!',
            ),
        ],
        'email' => [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|max_length[100]',
            'errors' => array (
                'required' => 'Email wajib diinput!',
                'valid_email' => 'Mohon input email yang valid!',
                'max_length' => 'Panjang email maksimal 100 karakter!',
            ),
        ],
        'birthdate' => [
            'field' => 'birthdate',
            'label' => 'Tanggal Lahir',
            'rules' => 'trim|required|valid_date',
            'errors' => array (
                'required' => 'Tanggal lahir wajib diinput!',
                'valid_date' => 'Mohon input tanggal lahir yang valid!'
            ),
        ],
        'address' => [
            'field' => 'address',
            'label' => 'Alamat',
            'rules' => 'trim|required|max_length[255]',
            'errors' => array (
                'required' => 'Alamat wajib diinput!',
                'max_length' => 'Panjang alamat maksimal 255 karakter!',
            ),
        ],
        'phone_number' => [
            'field' => 'phone_number',
            'label' => 'Nomor Telepon',
            'rules' => 'trim|required|max_length[15]|regex_match[^\d{4}-\d{4}-\d{4}$]',
            'error' => array (
                'required' => 'Nomor telepon wajib diinput!',
                'max_length' => 'Panjang nomor telepon maksimal 15 karakter!',
                'regex_match' => 'Mohon input nomor telepon yang valid!',
            ),
        ],
        'avatar' => [
            'field' => 'avatar',
            'label' => 'Avatar',
            'rules' => 'uploaded[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/gif]|max_size[avatar, 1024]',
            'errors' => array (
                'uploaded' => 'Avatar wajib diupload!',
                'mime_in' => 'Mohon input file yang valid untuk avatar!',
                'max_size' => 'Ukuran file avatar maksimal 1MB!',
            ),
        ],
    ];

    // Rules for verify password.
    public $passwordVerify = [
        'password' => [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required',
            'errors' => array (
                'required' => 'Anda belum menginput password!',
            )
        ],
    ];

    // Rules for edit user password.
    public $passwordEdit = [
        'password' => [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[8]|max_length[50]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/]',
            'errors' => array (
                'required' => 'Password wajib diinput!',
                'min_length' => 'Panjang password minimal 8 karakter!',
                'max_length' => 'Panjang password maksimal 50 karakter!',
                'regex_match' => 'Mohon input password yang valid!'
            ),
        ],
        'repeat_password' => [
            'field' => 'repeat_password',
            'rules' => 'trim|required|matches[password]',
            'errors' => array (
                'required' => 'Password harus diinput kembali pada kolom konfimasi password!',
                'matches' => 'Password tidak cocok!',
            ),
        ],
    ];

    // Rules for inserting thread data.
    public $threadAdd = [
        'title' => [
            'field' => 'title',
            'label' => 'Judul',
            'rules' => 'trim|required|is_unique[thread.title]',
            'errors' => array (
                'required' => 'Anda belum meng-input judul!',
                'is_unique' => 'Judul ini sudah diambil!',
            ),
        ],
        'category_id' => [
            'rules' => 'trim|required|max_length[11]|is_natural',
        ],
        'content' => [
            'field' => 'content',
            'label' => 'Isi',
            'rules' => 'trim|required|min_length[20]|max_length[30000]',
            'errors' => array (
                'required' => 'Anda belum menginput isi thread!',
                'min_length' => 'Isi thread minimal 20 karakter!',
                'max_length' => 'Isi thread maksimal 30.000 karakter!',
            ),
        ],
    ];

    // Rules for updating thread data.
    public $threadEdit = [
        'id' => [
            'rules' => 'trim|required|max_length[11]|is_natural',
        ],
        'title' => [
            'field' => 'title',
            'label' => 'Judul',
            'rules' => 'trim|required|is_unique[thread.title,id,{id}]',
            'errors' => array (
                'required' => 'Anda belum menginput judul!',
                'is_unique' => 'Judul ini sudah diambil!',
            ),
        ],
        'category_id' => [
            'rules' => 'trim|required|max_length[11]|is_natural',
        ],
        'content' => [
            'field' => 'content',
            'label' => 'Isi',
            'rules' => 'trim|required|min_length[20]|max_length[30000]',
            'errors' => array (
                'required' => 'Anda belum menginput isi thread!',
                'min_length' => 'Isi thread minimal 20 karakter!',
                'max_length' => 'Isi thread maksimal 30.000 karakter!',
            ),
        ],
    ];

    // Rules for reply.
    public $reply = [
        'content' => [
            'field' => 'content',
            'label' => 'Isi',
            'rules' => 'trim|required|min_length[20]|max_length[30000]',
            'errors' => array (
                'required' => 'Anda belum menginput isi reply!',
                'min_length' => 'Isi reply minimal 20 karakter!',
                'max_length' => 'Isi reply maksimal 30.000 karakter!',
            ),
        ],
    ];
}
