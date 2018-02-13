<?php
/**
 * Created by enea dhack - 31/07/17 10:00 PM.
 */

namespace Enea\Authorization\Test;

use Illuminate\Support\Facades\Schema;

class MigrationsTest extends TestCase
{
    public function test_the_migrations_were_successful()
    {
        $this->assertFalse(Schema::hasTable('non-existing'));
        $this->assertTrue(Schema::hasTable('roles'), 'The roles table was not found');
        $this->assertTrue(Schema::hasTable('permissions'), 'The permissions table was not found');
        $this->assertTrue(Schema::hasTable('role_permissions'), 'The role_permissions table was not found');
        $this->assertTrue(Schema::hasTable('authorizations'), 'The authorizations table was not found');
    }
}