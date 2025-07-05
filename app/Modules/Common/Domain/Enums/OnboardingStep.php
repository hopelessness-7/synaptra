<?php

namespace App\Modules\Common\Domain\Enums;

enum OnboardingStep: string
{
    case Welcome = 'welcome';
    case CreateProject = 'create_project';
    case CreateBoard = 'create_board';
    case CreateRoles = 'create_roles';
    case CreateRolesCustom = 'create_roles_custom';
    case EditRolesStandard = 'edit_roles_standard';
    case InviteTeam = 'invite_team';
    case Finish = 'finish';
}
