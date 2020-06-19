<?php


namespace YWatchman\LaravelEPP\Transformers;

use YWatchman\LaravelEPP\Contracts\Transformable;
use YWatchman\LaravelEPP\Support\Traits\Transformers\HasAuthentication;

class ContactTransformer extends Transformer
{
    use HasAuthentication;

    /**
     * ContactTransformer constructor.
     *
     * @param Transformable $transformable
     */
    public function __construct(Transformable $transformable)
    {
        parent::__construct($transformable);

        $this->transformed = $this->transform();
        $this->includeAuth();
    }

    /**
     * Transform contact model to array.
     *
     * @return array|void
     */
    public function toArray()
    {
        return $this->transformed;
    }

    /**
     * Return transformed array.
     *
     * @return array|void
     */
    protected function transform()
    {
        return [
            'id' => $this->transformable->external_identifier,
            'postalInfo' => [
                'attributes' => [
                    'type' => 'loc',
                ],
                'addr' => [
                    'street' => [
                        $this->transformable->street,
                        $this->transformable->number,
                        $this->transformable->suffix,
                    ],
                    'city' => $this->transformable->city,
                    'state' => $this->transformable->state,
                ],
            ],
            'voice' => $this->transformable->phone,
            'fax' => $this->transformable->fax,
            'email' => $this->transformable->email,
        ];
    }
}
