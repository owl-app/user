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

namespace Owl\Component\User\Security\Generator;

use Owl\Component\User\Security\Checker\UniquenessCheckerInterface;
use Sylius\Component\Resource\Generator\RandomnessGeneratorInterface;
use Webmozart\Assert\Assert;

final class UniquePinGenerator implements GeneratorInterface
{
    /** @var RandomnessGeneratorInterface */
    private $generator;

    /** @var UniquenessCheckerInterface */
    private $uniquenessChecker;

    /** @var int */
    private $pinLength;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(
        RandomnessGeneratorInterface $generator,
        UniquenessCheckerInterface $uniquenessChecker,
        int $pinLength,
    ) {
        Assert::greaterThanEq($pinLength, 1, 'The value of token length has to be at least 1.');

        $this->generator = $generator;
        $this->pinLength = $pinLength;
        $this->uniquenessChecker = $uniquenessChecker;
    }

    public function generate(): string
    {
        do {
            $pin = $this->generator->generateNumeric($this->pinLength);
        } while (!$this->uniquenessChecker->isUnique($pin));

        return $pin;
    }
}
