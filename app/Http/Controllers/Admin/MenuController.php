<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Service\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{

  protected $menuService;

  public function __construct(MenuService $menuService)
  {
    $this->menuService = $menuService;
  }

  public function index()
  {
    return view('admin.menu.list', [
      'title' => 'Danh sách Danh mục mới nhất',
      'menus' => $this->menuService->getAll(),
    ]);
  }

  public function create()
  {
    return view('admin.menu.add', [
      'title' => 'Thêm danh mục mới',
      'menus' => $this->menuService->getParent(),
    ]);
  }

  public function show(Menu $menu) { //Tự lấy id và check xem tồn tại trng database hay không
    return view('admin.menu.edit', [
      'title' => 'Chỉnh sửa Danh mục '. $menu->name,
      'menu' => $menu,
      'menus' => $this->menuService->getParent(),
    ]);
  }

  public function update(Menu $menu, CreateFormRequest $request) {
    $this->menuService->update($request, $menu);
    return redirect('/admin/menus/list');
  }

  public function store(CreateFormRequest $request)
  {
    $result = $this->menuService->create($request);

    return redirect()->back();
  }

  public function destroy(Request $request): JsonResponse
  {
    $result = $this->menuService->destroy($request);
    if ($result) {
      return response()->json(
        [
          'error' => false,
          'message' => 'Xóa thành công danh mục'
        ]
      );
    }
    return response()->json(
      [
        'error' => true,
      ]
    );
  }
}
