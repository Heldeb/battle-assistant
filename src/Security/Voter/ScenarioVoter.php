<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\Scenario;

final class ScenarioVoter extends Voter
{

    // ========== Ajouter constantes par souci de maintenance ==========
    public const SCENARIO_CREATE = 'scenario_create';
    public const SCENARIO_DELETE = 'scenario_delete';
    public const SCENARIO_EDIT = 'scenario_edit';


    // ========== Ajouter constructeur pour gérer le rôle admin ==========
    public function __construct(
        private Security $security
    ) {}

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
        $user = $token->getUser();

        // ========== Vérifier que l'utilisateur est connecté ==========
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ========== Vérifier s'il est admin ==========s
        return $this->security->isGranted('ROLE_ADMIN');
    }
}
