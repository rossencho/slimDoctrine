<?php

namespace Ross\SlimApi\Controllers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Ross\SlimApi\Entity\Product;

readonly class ProductController
{

    public function __construct(private EntityManager $em)
    {
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function create(Request $request, Response $response, $args): Response
    {
        $post = json_decode($request->getBody(), true);

        $product = new Product();
        $product->setName($post['name']);
        $product->setDescription($post['description']);
        $product->setPrice($post['price']);
        $product->setComment($post['comment']??'');
        $this->em->persist($product);
        $this->em->flush();

        return $response->withJson($product->toArray(), 201);
    }

    public function getAll(Request $request, Response $response, $args): Response
    {

        $products = $this->em->getRepository(Product::class)->findAll();
        $result = [];
        foreach ($products as $product)
        {
            $result[] = $product->toArray();
        }

        return $response->withJson($result, 200);
    }

    public function get(Request $request, Response $response, $args): Response
    {
        $product = $this->em->getRepository(Product::class)->find($args['id']);
        return $response->withJson($product->toArray(), 200);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function update(Request $request, Response $response, $args): Response
    {
        $product = $this->em->getRepository(Product::class)->find($args['id']);
        $data = json_decode($request->getBody(), true);

        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);
        $product->setComment($data['comment']??'');

        $this->em->persist($product);
        $this->em->flush();
        return $response->withJson($product->toArray(), 201);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function delete(Request $request, Response $response, $args): Response
    {
        $product = $this->em->getRepository(Product::class)->find($args['id']);
        $this->em->remove($product);
        $this->em->flush();
        return $response->withJson(["message" => "product with id=".$args['id'] ." deleted"], 200);
    }
}