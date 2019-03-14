<?php

namespace Application\Lib\Page;

interface FactoryInterface
{
	public function create(string $type): Page;
}