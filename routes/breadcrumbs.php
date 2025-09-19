<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Home > Dashboard > User Management
Breadcrumbs::for('user-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});

// Home > Dashboard > User Management > Roles
Breadcrumbs::for('user-management.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Roles', route('user-management.roles.index'));
});

// Home > Dashboard > User Management > Roles > [Role]
Breadcrumbs::for('user-management.roles.show', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('user-management.roles.index');
    $trail->push(ucwords($role->name), route('user-management.roles.show', $role));
});

// Home > Dashboard > User Management > Permission
Breadcrumbs::for('user-management.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Permissions', route('user-management.permissions.index'));
});

// Home > Dashboard > Audit Management
Breadcrumbs::for('audit-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Audit Management', route('audit-management.audits.index'));
});

// Home > Dashboard > Audit Management > Audits
Breadcrumbs::for('audit-management.audits.index', function (BreadcrumbTrail $trail) {
    $trail->parent('audit-management.index');
    $trail->push('Audit', route('audit-management.audits.index'));
});

// Home > Dashboard > Audit Management > Audits > View
Breadcrumbs::for('audit.view', function (BreadcrumbTrail $trail, $audit) {
    $trail->parent('audit-management.audits.index');
    $trail->push($audit->a_proj_title, route('audit.view', $audit->a_id)); // Ensure 'a_id' is used as the identifier
});


// Home > Dashboard > Audit Management > Audits > Evaluation
Breadcrumbs::for('audit.evaluate', function (BreadcrumbTrail $trail, $audit) {
    $trail->parent('audit-management.audits.index');
    $trail->push($audit->a_proj_title . ' - Evaluation', route('audit.evaluate', $audit->a_id));
});

// Home > Dashboard > Audit Management > Audits > Schedule
Breadcrumbs::for('audit.schedule', function (BreadcrumbTrail $trail, $audit) {
    $trail->parent('audit-management.audits.index');
    $trail->push($audit->a_proj_title . ' - Schedule', route('audit.schedule', $audit->a_id));
});
