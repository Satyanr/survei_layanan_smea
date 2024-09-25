<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PengaduanLink;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Pengguna extends Component
{
    public $searchuser, $name, $email, $role, $password, $password_confirmation, $user_id, $kode_unit, $penjab, $nip;
    public $updateMode = false,
        $unitMode = false,
        $insertMode = false;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $paginationName = 'Page';
    public function paginationView()
    {
        return 'components.admin.pagination_custom';
    }
    public function resetPageUser()
    {
        $this->gotoPage(1, 'Page');
    }

    public function updateRole()
    {
        if ($this->role === 'UnitKerja' || $this->role == 0) {
            $this->unitMode = true;
        } else {
            $this->unitMode = false;
        }
    }

    public function resetInput()
    {
        $this->name = null;
        $this->email = null;
        $this->role = null;
        $this->password = null;
        $this->password_confirmation = null;
        $this->penjab = null;
        $this->nip = null;
        $this->kode_unit = null;
    }
    public function render()
    {
        $searchuser = '%' . $this->searchuser . '%';
        return view('livewire.admin.pengguna', [
            'penggunas' => User::where('name', 'LIKE', $searchuser)
                ->orderBy('id', 'DESC')
                ->paginate(6, ['*'], $this->paginationName),
        ]);
    }

    public function forminput()
    {
        $this->resetInput();
        $this->insertMode = true;
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($this->role == 'UnitKerja' || $this->role == 0) {
            $this->validate([
                // 'kode_unit' => 'required',
                'penjab' => 'required',
                'nip' => 'required|unique:users,nip',
            ]);

            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => bcrypt($this->password),
                // 'kode_unit' => $this->kode_unit,
                'penanggung_jawab' => $this->penjab,
                'nip' => $this->nip,
            ]);
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => bcrypt($this->password),
            ]);
        }
        $this->unitMode = false;
        session()->flash('message', 'Pengguna berhasil ditambahkan');
        $this->resetInput();
        $this->insertMode = false;
    }
    public function edit($id)
    {
        try {
            $idec = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            
        }
        $this->updateMode = true;
        $this->user_id = $idec;
        $pengguna = User::where('id', $idec)->first();
        $this->name = $pengguna->name;
        $this->email = $pengguna->email;
        $this->role = $pengguna->role;
        $this->kode_unit = $pengguna->kode_unit;
        $this->penjab = $pengguna->penanggung_jawab;
        $this->nip = $pengguna->nip;

        if ($this->role === 'UnitKerja' || $this->role == 0) {
            $this->unitMode = true;
        } else {
            $this->unitMode = false;
        }
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);
        $roleMapping = [
            'UnitKerja' => 0,
            'Admin' => 1,
            'SuperAdmin' => 2,
        ];
        $roleInteger = $roleMapping[$this->role];

        $pengguna = User::find($this->user_id);
        if ($this->role == 'UnitKerja' || $this->role == 0) {
            $this->validate([
                // 'kode_unit' => 'required',
                'penjab' => 'required',
                'nip' => 'required|unique:users,nip,' . $pengguna->id,
            ]);
            if ($this->password != null) {
                $this->validate([
                    'password' => 'required|confirmed|min:6',
                ]);
                $pengguna->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'role' => $roleInteger,
                    'password' => bcrypt($this->password),
                    // 'kode_unit' => $this->kode_unit,
                    'penanggung_jawab' => $this->penjab,
                    'nip' => $this->nip,
                ]);
            } else {
                $pengguna->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'role' => $roleInteger,
                    // 'kode_unit' => $this->kode_unit,
                    'penanggung_jawab' => $this->penjab,
                    'nip' => $this->nip,
                ]);
            }
        } else {
            if ($this->password != null) {
                $this->validate([
                    'password' => 'required|confirmed|min:6',
                ]);

                $pengguna->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'role' => $roleInteger,
                    'password' => bcrypt($this->password),
                ]);
            } else {
                $pengguna->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'role' => $roleInteger,
                ]);
            }
        }
        $this->unitMode = false;
        $this->updateMode = false;
        session()->flash('message', 'Data Berhasil Di Edit');
        $this->resetInput();
    }
    public function cancel()
    {
        $this->unitMode = false;
        $this->insertMode = false;
        $this->updateMode = false;
        $this->resetInput();
    }
    public function delete($id)
    {
        try {
            $idec = Crypt::decrypt($id);
        } catch (DecryptException $e) {

        }

        PengaduanLink::where('user_id', $idec)->delete();
        User::find($idec)->delete();
        session()->flash('message', 'Pengguna berhasil dihapus');
    }
}
