<?php

namespace App\Modules\Common\Domain\Enums;

enum OnboardingStep: string
{
    case Welcome = 'welcome';
    case CreateProject = 'create_project';
    case CreateBoard = 'create_board';
    case InviteTeam = 'invite_team';
    case Finish = 'finish';
}
