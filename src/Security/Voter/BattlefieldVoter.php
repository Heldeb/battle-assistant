<?php

namespace App\Security\Voter;

use App\Entity\Battlefield;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class BattlefieldVoter extends Voter
{

    // ========== Ajouter constantes par souci de maintenance ==========
    public const BATTLEFIELD_CREATE = 'battlefield_create';
    public const BATTLEFIELD_DELETE = 'battlefield_delete';
    public const BATTLEFIELD_EDIT = 'battlefield_edit';

    // ========== Vérifier le subject ==========
    protected function supports(string $attribute, mixed $battlefield): bool
    {
        if ($attribute === self::BATTLEFIELD_CREATE) {
            return true;
        }
        return in_array($attribute, [self::BATTLEFIELD_EDIT, self::BATTLEFIELD_DELETE,], true)
            && $battlefield instanceof Battlefield;
    }

    // ========== Vérifier le user ==========
    protected function voteOnAttribute(string $attribute, mixed $battlefield, TokenInterface $token, ?Vote $vote = null): bool
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
