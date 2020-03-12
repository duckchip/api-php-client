<?php

namespace Akeneo\Pim\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\Pagination\PageFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\PageInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;

/**
 * API implementation to manage measure families.
 *
 * @author    Philippe Mossière <philippe.mossiere@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 *
 * @deprecated use \Akeneo\Pim\ApiClient\Client\ResourceClientInterface\MeasurementFamilyApi
 */
class MeasureFamilyApi implements MeasureFamilyApiInterface
{
    const MEASURE_FAMILY_URI = 'api/rest/v1/measure-families/%s';
    const MEASURE_FAMILIES_URI = 'api/rest/v1/measure-families';

    /** @var ResourceClientInterface */
    protected $resourceClient;

    /** @var PageFactoryInterface */
    protected $pageFactory;

    /** @var ResourceCursorFactoryInterface */
    protected $cursorFactory;

    /**
     * @param ResourceClientInterface        $resourceClient
     * @param PageFactoryInterface           $pageFactory
     * @param ResourceCursorFactoryInterface $cursorFactory
     */
    public function __construct(
        ResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory
    ) {
        $this->resourceClient = $resourceClient;
        $this->pageFactory = $pageFactory;
        $this->cursorFactory = $cursorFactory;
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated use \Akeneo\Pim\ApiClient\Client\ResourceClientInterface\MeasurementFamilyApi::all() and filter on
     *             the measurement family code you want to fetch manually.
     */
    public function get(string $code): array
    {
        return $this->resourceClient->getResource(static::MEASURE_FAMILY_URI, [$code]);
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated use \Akeneo\Pim\ApiClient\Client\ResourceClientInterface\MeasurementFamilyApi::all()
     */
    public function listPerPage(int $limit = 10, bool $withCount = false, array $queryParameters = []): PageInterface
    {
        $data = $this->resourceClient->getResources(static::MEASURE_FAMILIES_URI, [], $limit, $withCount, $queryParameters);

        return $this->pageFactory->createPage($data);
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated use \Akeneo\Pim\ApiClient\Client\ResourceClientInterface\MeasurementFamilyApi::all()
     */
    public function all(int $pageSize = 10, array $queryParameters = []): ResourceCursorInterface
    {
        $firstPage = $this->listPerPage($pageSize, false, $queryParameters);

        return $this->cursorFactory->createCursor($pageSize, $firstPage);
    }
}
