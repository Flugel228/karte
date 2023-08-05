<?php declare(strict_types=1);

namespace App\Http\Controllers\Client\Admin;

use App\Contracts\Services\UserServiceContract;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserController extends BaseController
{
    public function __construct(
        private readonly UserServiceContract $service,
    )
    {
        parent::__construct();
    }

    /**
     * Display list of users.
     *
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $quantity = 10;
        $users = $this->service->paginate($quantity);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Display create user page.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $roles = User::getRoles();
        $genders = User::getGenders();
        return view('admin.user.create', compact('roles', 'genders'));
    }

    /**
     * @param User $user
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function show(User $user): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $roles = User::getRoles();
        $genders = User::getGenders();
        return view('admin.user.show', compact('user', 'roles', 'genders'));
    }

    /**
     * @param User $user
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit(User $user): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $roles = User::getRoles();
        $genders = User::getGenders();
        return view('admin.user.edit', compact('user', 'roles', 'genders'));
    }
}
