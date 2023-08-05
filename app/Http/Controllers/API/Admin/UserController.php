<?php declare(strict_types=1);

namespace App\Http\Controllers\API\Admin;

use App\Contracts\Services\UserServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Admin\User\StoreRequest;
use App\Http\Requests\API\Admin\User\UpdateRequest;
use App\Models\User;
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
