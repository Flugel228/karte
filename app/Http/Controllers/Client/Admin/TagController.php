<?php declare(strict_types=1);

namespace App\Http\Controllers\Client\Admin;

use App\Contracts\Services\TagServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Admin\Tag\StoreRequest;
use App\Http\Requests\API\Admin\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TagController extends BaseController
{
    public function __construct(
        private readonly TagServiceContract $service,
    )
    {
        parent::__construct();
    }

    /**
     * Display list of tags.
     *
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $quantity = 10;
        $tags = $this->service->paginate($quantity);
        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Display create tag page.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('admin.tag.create');
    }

    /**
     * @param Tag $tag
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function show(Tag $tag): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.tag.show', compact('tag'));
    }

    /**
     * @param Tag $tag
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit(Tag $tag): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('tags.index');
    }

    /**
     * @param UpdateRequest $request
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Tag $tag): RedirectResponse
    {
        $data = $request->validated();
        $response = $this->service->update($tag->id, $data);
        if ($response === 'title') {
            return redirect()->back()->withErrors(['title' => 'Тег с таким названием уже существует.']);
        }
        return redirect()->route('tags.index');
    }

    /**
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $this->service->destroy($tag->id);
        return redirect()->route('tags.index');
    }
}
