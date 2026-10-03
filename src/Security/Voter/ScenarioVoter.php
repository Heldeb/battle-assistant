<?php

namespace App\Security\Voter;

use App\Entity\Scenario;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class ScenarioVoter extends Voter
{

    // ========== Ajouter constantes par souci de maintenance ==========
    public const SCENARIO_CREATE = 'scenario_create';
    public const SCENARIO_DELETE = 'scenario_delete';
    public const SCENARIO_EDIT = 'scenario_edit';

    // ========== Vérifier le subject ==========
    protected function supports(string $attribute, mixed $scenario): bool
    {
        if ($attribute === self::SCENARIO_CREATE) {
            return true;
        }
        return in_array($attribute, [self::SCENARIO_EDIT, self::SCENARIO_DELETE,], true)
            && $scenario instanceof Scenario;
    }

    // ========== Vérifier le user ==========
    protected function voteOnAttribute(string $attribute, mixed $scenario, TokenInterface $token, ?Vote $vote = null): bool
    {
        // Cette partie n'est pas indispensable mais je le laisse pour que ce soit plus explicite
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ========== Vérifier s'il est admin ==========s
        return in_array('ROLE_ADMIN', $token->getRoleNames(), true);
    }
}
