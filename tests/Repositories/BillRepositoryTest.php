<?php

class BillRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->bill = $this->mock('Bdgt\Resources\Bill[save,delete]');
        $this->repository = Mockery::mock('Bdgt\Repositories\Eloquent\EloquentBillRepository[instance]', [$this->bill]);
        $this->repository->scopeBy('user_id', 'testing');
    }

    /**
     * Test that the repository 'create' method sets attributes and saves a model
     */
    public function testCreateMethodIsCalled()
    {
        $billArray = [
            'label' => 'Acme'
        ];

        $this->repository->shouldReceive('instance')->once()->andReturn($this->bill);
        $this->bill->shouldReceive('save')->once();

        $this->repository->create($billArray);

        $this->assertEquals('Acme', $this->bill->label);
    }

    /**
     * Test that the repository 'update' method changes attributes and saves a model
     */
    public function testUpdateMethodIsCalled()
    {
        $billArray = [
            'label' => 'Acme'
        ];

        $this->repository->shouldReceive('instance')->once()->with('id', 1)->andReturn($this->bill);
        $this->bill->shouldReceive('save')->once();

        $this->repository->update($billArray, 1);

        $this->assertEquals('Acme', $this->bill->label);
    }

    /**
     * Test that the repository 'delete' method deletes a model
     */
    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->repository->shouldReceive('instance')->once()->with('id', $id)->andReturn($this->bill);
        $this->bill->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
