<?php declare(strict_types=1);

namespace App\Http\Controllers\Client\Admin;

use App\Contracts\Services\ProductServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Admin\Product\StoreRequest;
use App\Http\Requests\API\Admin\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends BaseController
{
    public function __construct(
        private readonly ProductServiceContract $service,
    )
    {
        parent::__construct();
    }

    /**
     * Display list of products.
     *
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $quantity = 10;
        $page = (int)request()->query('page', 1);
        $path = request()->getPathInfo();
        $products = $this->service->paginate($quantity, $page, $path);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Display create product page.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $categories = $this->getService()->getAllCategories();
        $colors = $this->getService()->getAllColors();
        $tags = $this->getService()->getAllTags();
        return view('admin.product.create', compact('categories', 'colors', 'tags'));
    }

    /**
     * @param int $id
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function show(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $product = $this->service->findById($id);
        if ($product === null) {
            abort(404);
        }
        return view('admin.product.show', compact('product'));
    }

    /**
     * @param Product $product
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit(Product $product): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $categories = $this->getService()->getAllCategories();
        $colors = $this->getService()->getAllColors();
        $tags = $this->getService()->getAllTags();
        return view('admin.product.edit', compact('product', 'categories', 'colors', 'tags'));
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $this->getService()->store($data);
        return redirect()->route('products.index');
    }

    /**
     * @param UpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $response = $this->getService()->update($product->id, $data);
        if ($response === 'title') {
            return redirect()->back()->withErrors(['title' => 'Продукт с таким названием уже существует.']);
        }
        return redirect()->route('products.index');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->getService()->destroy($product->id);
        return redirect()->route('products.index');
    }

    /**
     * @return ProductServiceContract
     */
    public function getService(): ProductServiceContract
    {
        return $this->service;
    }
}
