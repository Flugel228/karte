<?php declare(strict_types=1);

namespace App\Http\Controllers\Client\Admin;

use App\Contracts\Services\CategoryServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Admin\Category\StoreRequest;
use App\Http\Requests\API\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends BaseController
{
    public function __construct(
        private readonly CategoryServiceContract $service,
    )
    {
        parent::__construct();
    }

    /**
     * Display list of categories.
     *
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $quantity = 10;
        $page = (int)request()->query('page', 1);
        $path = request()->getPathInfo();
        $categories = $this->service->paginate($quantity, $page, $path);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Display create category page.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('admin.category.create');
    }

    /**
     * @param int $id
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function show(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $category = $this->service->findById($id);
        if ($category === null) {
            abort(404);
        }
        return view('admin.category.show', compact('category'));
    }

    /**
     * @param Category $category
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit(Category $category): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('categories.index');
    }

    /**
     * @param UpdateRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        $response = $this->service->update($category->id, $data);
        if ($response === 'title') {
            return redirect()->back()->withErrors(['title' => 'Категория с таким названием уже существует.']);
        }
        return redirect()->route('categories.index');
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->service->destroy($category->id);
        return redirect()->route('categories.index');
    }
}
