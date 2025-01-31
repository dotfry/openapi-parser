<?php

namespace Tests\OpenAPI;

use OpenAPI\Parser\SwaggerParser;
use OpenAPI\Schema\V2 as Schema;
use PHPUnit\Framework\TestCase;

class SwaggerParserTest extends TestCase
{

    public function testBasic()
    {

        $Parser = new SwaggerParser();

        $result = $Parser->parse(json_decode(file_get_contents(__DIR__ . '/Fixture/petstore-swagger.json'), true));

        $this->assertInstanceOf(Schema\Swagger::class, $result);

        $Info = $result->info;

        $this->assertInstanceOf(Schema\Info::class, $Info);

        $Paths = $result->paths;

        $this->assertInstanceOf(Schema\Paths::class, $Paths);

        /** @var Schema\PathItem $PetsPath */
        $PetsPath = $Paths->getPatternedField('/pet');

        $this->assertInstanceOf(Schema\PathItem::class, $PetsPath);

        $GetOperation = $PetsPath->put;

        $this->assertInstanceOf(Schema\Operation::class, $GetOperation);

        $responses = $GetOperation->responses;

        $this->assertInstanceOf(Schema\Responses::class, $responses);

        /** @var Schema\Response $response200 */
        $response400 = $responses->getPatternedField('400');

        $this->assertInstanceOf(Schema\Response::class, $response400);


    }
}
