<?php

namespace App\Http\Middleware;

// use App\Enums\RoleEnum;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $this->getFieldValue($request, 'user');
        $profile = $this->getFieldValue($request, 'profile');
        $role = $this->getFieldValue($request, 'role');

        // dd(...(new Ziggy)->toArray());

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
                'role' => $role,
                // 'profile' => $profile,
                // 'type' => $this->getFieldValue($request, 'type'),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'categories' => $this->getCategories($request),
        ];
    }

    public function getCategories(Request $request): array
    {
        return match ($request->route()->action['as'] ?? '') {
            'index' => Category::getAll(),
            'category.index' => Category::getAll(),
            'index.catalog' => Category::getAll(),
            'index.catalog.chapter' => Category::getAll(),
            'index.catalog.chapter.category' => Category::getAll(),
            default => []
        };
    }

    public function getFieldValue(Request $request, string $field): mixed
    {
        $user = $request->user();

        return is_null($user)
            ? null
            : match ($field) {
                'user' => $user,
                'profile' => $user->profile,
                'role' => $user->role::getEnumName()::{$user->role->name}->value,
                'type' => $user->type::getEnumName()::{$user->type->name}->value,
                default => null,
            };
    }
}
