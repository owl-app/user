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

namespace spec\Owl\Component\User\Security\Checker;

use Owl\Component\User\Security\Checker\UniquenessCheckerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class TokenUniquenessCheckerSpec extends ObjectBehavior
{
    function let(RepositoryInterface $repository): void
    {
        $this->beConstructedWith($repository, 'aRandomToken');
    }

    function it_implements_token_uniqueness_checker_interface(): void
    {
        $this->shouldImplement(UniquenessCheckerInterface::class);
    }

    function it_returns_true_when_token_is_not_used(RepositoryInterface $repository): void
    {
        $repository->findOneBy(['aRandomToken' => 'freeToken'])->willReturn(null);

        $this->isUnique('freeToken')->shouldReturn(true);
    }

    function it_returns_false_when_token_is_in_use(RepositoryInterface $repository): void
    {
        $repository->findOneBy(['aRandomToken' => 'takenToken'])->willReturn(Argument::any());

        $this->isUnique('takenToken')->shouldReturn(false);
    }
}
