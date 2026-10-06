<?php

namespace App\Security\Voter;

use App\Entity\Component;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class ComponentVoter extends Voter
{

    // ========== Ajouter constantes par souci de maintenance ==========
    public const COMPONENT_CREATE = 'component_create';
    public const COMPONENT_DELETE = 'component_delete';
    public const COMPONENT_EDIT = 'component_edit';

    // ========== Vérifier le subject ==========
    protected function supports(string $attribute, mixed $component): bool
    {

        if ($attribute === self::COMPONENT_CREATE) {
            return true;
        }
        return in_array($attribute, [self::COMPONENT_EDIT, self::COMPONENT_DELETE,], true)
            && $component instanceof Component;
    }

    // ========== Vérifier le user ==========
    protected function voteOnAttribute(string $attribute, mixed $component, TokenInterface $token, ?Vote $vote = null): bool
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
