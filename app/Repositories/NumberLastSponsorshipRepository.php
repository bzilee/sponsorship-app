<?php
/**
 * @copyright Copyright (c) 2019. Tankeu B.zile
 * @author    Tankeu B.zile <b.ziletankeu@gmail.com>
 * @author    Chinzoumka Tchindebe <christiantchindebe@outlook.fr>
 * @link      https://github.com/TankeuBzile
 */


namespace App\Repositories;

use App\Models\NumberLastSponsorship;

class NumberLastSponsorshipRepository
{
    /**
     * @var NumberLastSponsorship
     */
    private $model;

    /**
     * NumberLastSponsorshipRepository constructor.
     * @param NumberLastSponsorship $model
     */
    public function __construct(NumberLastSponsorship $model)
    {
        $this->model = $model;
    }

    /**
     * Return a new instance of NumberLastSponsorship Model
     *
     * @return NumberLastSponsorship
     */
    public function newInstance()
    {
        return $this->model->newInstance();
    }
}
