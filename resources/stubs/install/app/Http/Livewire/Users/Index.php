<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'Name';
    public $sorts = ['Name', 'Newest', 'Oldest'];
    public $filter = 'All';
    public $filters = ['All', 'Unverified', 'Verified'];

    protected $listeners = ['$refresh'];

    public function route()
    {
        return Route::get('/users', static::class)
            ->name('users')
            ->middleware('auth');
    }

    public function render()
    {
        return view('users.index', [
            'users' => $this->query()->paginate(),
        ]);
    }

    public function query()
    {
        $query = User::query();

        if ($this->search) {
            $query->where(function (Builder $query) {
                $query->orWhere('name', 'like', '%' . $this->search . '%');
                $query->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        switch ($this->sort) {
            case 'Name': $query->orderBy('name'); break;
            case 'Newest': $query->orderByDesc('created_at'); break;
            case 'Oldest': $query->orderBy('created_at'); break;
        }

        switch ($this->filter) {
            case 'All': break;
            case 'Unverified': $query->whereNull('email_verified_at'); break;
            case 'Verified': $query->whereNotNull('email_verified_at'); break;
        }

        return $query;
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
