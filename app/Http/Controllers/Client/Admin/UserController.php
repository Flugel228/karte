<?php declare(strict_types=1);

namespace App\Http\Controllers\Client\Admin;

use App\Contracts\Services\UserServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Admin\User\StoreRequest;
use App\Http\Requests\API\Admin\User\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
        $page = (int)request()->query('page', 1);
        $path = request()->getPathInfo();
        $users = $this->service->paginate($quantity, $page, $path);
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
     * @param int $id
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function show(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $roles = User::getRoles();
        $genders = User::getGenders();
        $user = $this->service->findById($id);
        if ($user === null) {
            abort(404);
        }
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

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('users.index');
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        $response = $this->service->update($user->id, $data);
        if ($response === 'email') {
            return redirect()->back()->withErrors(['email' => 'Аккаунт с таким адресом уже существует.']);
        }
        return redirect()->route('users.index');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->service->destroy($user->id);
        return redirect()->route('users.index');
    }
}
