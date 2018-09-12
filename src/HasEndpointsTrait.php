<?php

declare(strict_types=1);

/*
 * This file is part of the PascalCoin PHP package.
 *
 * (c) Benjamin Ansbach <benjaminansbach@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Techworker\PascalCoin;

trait HasEndpointsTrait
{
    /**
     * @var EndPoint[]
     */
    protected $endPoints = [];

    /**
     * Sets the currently used endpoints.
     *
     * @param EndPoint ...$endPoints
     *
     * @return HasEndpointsTrait
     */
    public function setEndpoints(EndPoint ...$endPoints): self
    {
        $this->endPoints = $endPoints;

        return $this;
    }

    /**
     * Gets an endpoint to request to.
     *
     * @return EndPoint
     */
    protected function getEndPoint(): EndPoint
    {
        if (count($this->endPoints) > 1) {
            $this->endPoints[array_rand($this->endPoints)];
        }

        if (count($this->endPoints) === 0) {
            throw new \Exception('No endpoints available');
        }

        return current($this->endPoints);
    }
}
