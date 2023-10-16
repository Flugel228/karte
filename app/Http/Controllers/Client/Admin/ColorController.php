<?php declare(strict_types=1);

namespace App\Http\Controllers\Client\Admin;

use App\Contracts\Services\ColorServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Admin\Color\StoreRequest;
use App\Http\Requests\API\Admin\Color\UpdateRequest;
use App\Models\Color;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ColorController extends BaseController
{
    public function __construct(
        private readonly ColorServiceContract $service,
    )
    {
        parent::__construct();
    }

    /**
     * Display list of colors.
     *
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $quantity = 10;
        $page = (int)request()->query('page', 1);
        $path = request()->getPathInfo();
        $colors = $this->service->paginate($quantity, $page, $path);
        return view('admin.color.index', compact('colors'));
    }

    /**
     * Display create color page.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('admin.color.create');
    }

    /**
     * @param int $id
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function show(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $color = $this->service->findById($id);
        if ($color === null) {
            abort(404);
        }
        return view('admin.color.show', compact('color'));
    }

    /**
     * @param Color $color
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit(Color $color): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.color.edit', compact('color'));
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('colors.index');
    }

    /**
     * @param UpdateRequest $request
     * @param Color $color
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Color $color): RedirectResponse
    {
        $data = $request->validated();
        $response = $this->service->update($color->id, $data);
        if ($response === 'title') {
            return redirect()->back()->withErrors(['title' => 'Цвет с таким названием уже существует.']);
        } elseif ($response === 'code') {
            return redirect()->back()->withErrors(['code' => 'Цвет с таким кодом уже существует.']);
        } elseif ($response === 'title&code') {
            return redirect()->back()->withErrors([
                'title' => 'Цвет с таким названием уже существует.',
                'code' => 'Цвет с таким кодом уже существует.',
            ]);
        }
        return redirect()->route('colors.index');
    }

    /**
     * @param Color $color
     * @return RedirectResponse
     */
    public function destroy(Color $color): RedirectResponse
    {
        $this->service->destroy($color->id);
        return redirect()->route('colors.index');
    }
}
