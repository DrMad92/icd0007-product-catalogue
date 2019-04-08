<?php

namespace Base;

use \CategorySubcategory as ChildCategorySubcategory;
use \CategorySubcategoryQuery as ChildCategorySubcategoryQuery;
use \Exception;
use Map\CategorySubcategoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'category_subcategory' table.
 *
 *
 *
 * @method     ChildCategorySubcategoryQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method     ChildCategorySubcategoryQuery orderBySubcategoryId($order = Criteria::ASC) Order by the subcategory_id column
 *
 * @method     ChildCategorySubcategoryQuery groupByCategoryId() Group by the category_id column
 * @method     ChildCategorySubcategoryQuery groupBySubcategoryId() Group by the subcategory_id column
 *
 * @method     ChildCategorySubcategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategorySubcategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategorySubcategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategorySubcategoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCategorySubcategoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCategorySubcategoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCategorySubcategoryQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildCategorySubcategoryQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildCategorySubcategoryQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildCategorySubcategoryQuery joinWithCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Category relation
 *
 * @method     ChildCategorySubcategoryQuery leftJoinWithCategory() Adds a LEFT JOIN clause and with to the query using the Category relation
 * @method     ChildCategorySubcategoryQuery rightJoinWithCategory() Adds a RIGHT JOIN clause and with to the query using the Category relation
 * @method     ChildCategorySubcategoryQuery innerJoinWithCategory() Adds a INNER JOIN clause and with to the query using the Category relation
 *
 * @method     ChildCategorySubcategoryQuery leftJoinSubcategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subcategory relation
 * @method     ChildCategorySubcategoryQuery rightJoinSubcategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subcategory relation
 * @method     ChildCategorySubcategoryQuery innerJoinSubcategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Subcategory relation
 *
 * @method     ChildCategorySubcategoryQuery joinWithSubcategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Subcategory relation
 *
 * @method     ChildCategorySubcategoryQuery leftJoinWithSubcategory() Adds a LEFT JOIN clause and with to the query using the Subcategory relation
 * @method     ChildCategorySubcategoryQuery rightJoinWithSubcategory() Adds a RIGHT JOIN clause and with to the query using the Subcategory relation
 * @method     ChildCategorySubcategoryQuery innerJoinWithSubcategory() Adds a INNER JOIN clause and with to the query using the Subcategory relation
 *
 * @method     \CategoryQuery|\SubcategoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategorySubcategory findOne(ConnectionInterface $con = null) Return the first ChildCategorySubcategory matching the query
 * @method     ChildCategorySubcategory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCategorySubcategory matching the query, or a new ChildCategorySubcategory object populated from the query conditions when no match is found
 *
 * @method     ChildCategorySubcategory findOneByCategoryId(int $category_id) Return the first ChildCategorySubcategory filtered by the category_id column
 * @method     ChildCategorySubcategory findOneBySubcategoryId(int $subcategory_id) Return the first ChildCategorySubcategory filtered by the subcategory_id column *

 * @method     ChildCategorySubcategory requirePk($key, ConnectionInterface $con = null) Return the ChildCategorySubcategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategorySubcategory requireOne(ConnectionInterface $con = null) Return the first ChildCategorySubcategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategorySubcategory requireOneByCategoryId(int $category_id) Return the first ChildCategorySubcategory filtered by the category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategorySubcategory requireOneBySubcategoryId(int $subcategory_id) Return the first ChildCategorySubcategory filtered by the subcategory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategorySubcategory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCategorySubcategory objects based on current ModelCriteria
 * @method     ChildCategorySubcategory[]|ObjectCollection findByCategoryId(int $category_id) Return ChildCategorySubcategory objects filtered by the category_id column
 * @method     ChildCategorySubcategory[]|ObjectCollection findBySubcategoryId(int $subcategory_id) Return ChildCategorySubcategory objects filtered by the subcategory_id column
 * @method     ChildCategorySubcategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CategorySubcategoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CategorySubcategoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CategorySubcategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategorySubcategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategorySubcategoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCategorySubcategoryQuery) {
            return $criteria;
        }
        $query = new ChildCategorySubcategoryQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCategorySubcategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The CategorySubcategory object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        throw new LogicException('The CategorySubcategory object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCategorySubcategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The CategorySubcategory object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCategorySubcategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The CategorySubcategory object has no primary key');
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId(1234); // WHERE category_id = 1234
     * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
     * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id > 12
     * </code>
     *
     * @see       filterByCategory()
     *
     * @param     mixed $categoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategorySubcategoryQuery The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, $comparison = null)
    {
        if (is_array($categoryId)) {
            $useMinMax = false;
            if (isset($categoryId['min'])) {
                $this->addUsingAlias(CategorySubcategoryTableMap::COL_CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryId['max'])) {
                $this->addUsingAlias(CategorySubcategoryTableMap::COL_CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategorySubcategoryTableMap::COL_CATEGORY_ID, $categoryId, $comparison);
    }

    /**
     * Filter the query on the subcategory_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySubcategoryId(1234); // WHERE subcategory_id = 1234
     * $query->filterBySubcategoryId(array(12, 34)); // WHERE subcategory_id IN (12, 34)
     * $query->filterBySubcategoryId(array('min' => 12)); // WHERE subcategory_id > 12
     * </code>
     *
     * @see       filterBySubcategory()
     *
     * @param     mixed $subcategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategorySubcategoryQuery The current query, for fluid interface
     */
    public function filterBySubcategoryId($subcategoryId = null, $comparison = null)
    {
        if (is_array($subcategoryId)) {
            $useMinMax = false;
            if (isset($subcategoryId['min'])) {
                $this->addUsingAlias(CategorySubcategoryTableMap::COL_SUBCATEGORY_ID, $subcategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subcategoryId['max'])) {
                $this->addUsingAlias(CategorySubcategoryTableMap::COL_SUBCATEGORY_ID, $subcategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategorySubcategoryTableMap::COL_SUBCATEGORY_ID, $subcategoryId, $comparison);
    }

    /**
     * Filter the query by a related \Category object
     *
     * @param \Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategorySubcategoryQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \Category) {
            return $this
                ->addUsingAlias(CategorySubcategoryTableMap::COL_CATEGORY_ID, $category->getId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategorySubcategoryTableMap::COL_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type \Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategorySubcategoryQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\CategoryQuery');
    }

    /**
     * Filter the query by a related \Subcategory object
     *
     * @param \Subcategory|ObjectCollection $subcategory The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategorySubcategoryQuery The current query, for fluid interface
     */
    public function filterBySubcategory($subcategory, $comparison = null)
    {
        if ($subcategory instanceof \Subcategory) {
            return $this
                ->addUsingAlias(CategorySubcategoryTableMap::COL_SUBCATEGORY_ID, $subcategory->getId(), $comparison);
        } elseif ($subcategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategorySubcategoryTableMap::COL_SUBCATEGORY_ID, $subcategory->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySubcategory() only accepts arguments of type \Subcategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Subcategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategorySubcategoryQuery The current query, for fluid interface
     */
    public function joinSubcategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Subcategory');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Subcategory');
        }

        return $this;
    }

    /**
     * Use the Subcategory relation Subcategory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SubcategoryQuery A secondary query class using the current class as primary query
     */
    public function useSubcategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSubcategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Subcategory', '\SubcategoryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCategorySubcategory $categorySubcategory Object to remove from the list of results
     *
     * @return $this|ChildCategorySubcategoryQuery The current query, for fluid interface
     */
    public function prune($categorySubcategory = null)
    {
        if ($categorySubcategory) {
            throw new LogicException('CategorySubcategory object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the category_subcategory table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategorySubcategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategorySubcategoryTableMap::clearInstancePool();
            CategorySubcategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategorySubcategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategorySubcategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CategorySubcategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CategorySubcategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CategorySubcategoryQuery
