<?php

namespace OsintCat\Vin\Requests;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Vin\Types\QueryVinRequestType;
use OsintCat\Vin\Types\QueryVinRequestUnits;

class QueryVinRequest extends JsonSerializableType
{
    /**
     * @var ?value-of<QueryVinRequestType> $operation `decode` (default), `batch`, `wmi`, `makes`, `manufacturers`, `variables` or `canadian`.
     */
    public ?string $operation;

    /**
     * @var ?string $query The VIN (`decode`), VINs separated by new lines, up to 50 (`batch`), a WMI (`wmi`), or the make / manufacturer / variable name the chosen `search_type` needs. Not needed for `makes`+`all`, `manufacturers`+`all`/`parts`, `variables`+`list` and `canadian`.
     */
    public ?string $query;

    /**
     * @var ?float $modelYear `decode`: model year, improves accuracy.
     */
    public ?float $modelYear;

    /**
     * @var ?bool $extended `decode`: `true` for the extended field set.
     */
    public ?bool $extended;

    /**
     * @var ?string $searchType `makes`: `all`, `manufacturer`, `vehicletype`, `models`, `vehicletypes`. `manufacturers`: `all`, `details`, `wmis`, `parts`. `variables`: `list`, `values`.
     */
    public ?string $searchType;

    /**
     * @var ?float $year `makes` with `manufacturer`/`models`, and `canadian`: model year.
     */
    public ?float $year;

    /**
     * @var ?string $vehicleType `makes`+`models` and `manufacturers`+`wmis`: vehicle type filter.
     */
    public ?string $vehicleType;

    /**
     * @var ?string $mfrType `manufacturers`+`all`: manufacturer type filter.
     */
    public ?string $mfrType;

    /**
     * @var ?float $page `manufacturers`+`all`/`parts`: page number.
     */
    public ?float $page;

    /**
     * @var ?string $partsType `manufacturers`+`parts`: CFR part, default `565`.
     */
    public ?string $partsType;

    /**
     * @var ?string $fromDate `manufacturers`+`parts`: start date (required there).
     */
    public ?string $fromDate;

    /**
     * @var ?string $toDate `manufacturers`+`parts`: end date (required there).
     */
    public ?string $toDate;

    /**
     * @var ?string $make `canadian`: make.
     */
    public ?string $make;

    /**
     * @var ?string $model `canadian`: model.
     */
    public ?string $model;

    /**
     * @var ?value-of<QueryVinRequestUnits> $units `canadian`: `Metric` (default) or `US`.
     */
    public ?string $units;

    /**
     * @param array{
     *   operation?: ?value-of<QueryVinRequestType>,
     *   query?: ?string,
     *   modelYear?: ?float,
     *   extended?: ?bool,
     *   searchType?: ?string,
     *   year?: ?float,
     *   vehicleType?: ?string,
     *   mfrType?: ?string,
     *   page?: ?float,
     *   partsType?: ?string,
     *   fromDate?: ?string,
     *   toDate?: ?string,
     *   make?: ?string,
     *   model?: ?string,
     *   units?: ?value-of<QueryVinRequestUnits>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->operation = $values['operation'] ?? null;
        $this->query = $values['query'] ?? null;
        $this->modelYear = $values['modelYear'] ?? null;
        $this->extended = $values['extended'] ?? null;
        $this->searchType = $values['searchType'] ?? null;
        $this->year = $values['year'] ?? null;
        $this->vehicleType = $values['vehicleType'] ?? null;
        $this->mfrType = $values['mfrType'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->partsType = $values['partsType'] ?? null;
        $this->fromDate = $values['fromDate'] ?? null;
        $this->toDate = $values['toDate'] ?? null;
        $this->make = $values['make'] ?? null;
        $this->model = $values['model'] ?? null;
        $this->units = $values['units'] ?? null;
    }
}
