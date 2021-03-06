<?php

declare(strict_types=1);

/**
 * @author enea dhack <me@enea.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Enea\Authorization\Tests\Repositories;

use Enea\Authorization\Contracts\Grantable;
use Enea\Authorization\Repositories\Authorization;
use Enea\Authorization\Repositories\Repository;
use Enea\Authorization\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

abstract class RepositoryTestCase extends TestCase
{
    abstract protected function repository(): Repository;

    abstract protected function create(string $name, string $description = null): Grantable;

    abstract protected function table(): string;

    public function test_can_create_a_multiple_authorizations_from_the_repository(): void
    {
        $structs = [
            Authorization::fake('First Authorization'),
            Authorization::fake('Second Authorization'),
        ];

        $authorizations = $this->repository()->createMultiple($structs);

        $authorizations->each(function (Model $authorization) {
            $this->assertDatabaseHas($this->table(), $authorization->toArray());
        });

        $this->assertCount(count($structs), $authorizations);
    }

    public function test_can_delete_a_authorization_from_the_repository(): void
    {
        $authorization = $this->create('Authorization');
        $this->assertTrue($this->repository()->delete($authorization->getSecretName()));
        $this->assertDatabaseMissing($this->table(), [
            'secret_name' => 'authorization',
        ]);
    }
}
