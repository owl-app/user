<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Owl\Component\User\Repository;

use Sylius\Component\Resource\Repository\RepositoryInterface;
use Owl\Component\User\Model\UserInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findOneByEmail(string $email): ?UserInterface;
}
