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

namespace spec\Owl\Component\User\Canonicalizer;

use Owl\Component\User\Canonicalizer\CanonicalizerInterface;
use PhpSpec\ObjectBehavior;

final class CanonicalizerSpec extends ObjectBehavior
{
    function it_implements_canonicalizer_interface(): void
    {
        $this->shouldImplement(CanonicalizerInterface::class);
    }

    function it_converts_strings_to_lower_case(): void
    {
        $testString = 'tEsTsTrInG';
        $this->canonicalize($testString)->shouldReturn('teststring');
    }
}
