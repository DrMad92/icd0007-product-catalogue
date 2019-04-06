
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(65) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- subcategory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `subcategory`;

CREATE TABLE `subcategory`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(65) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- category_subcategory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category_subcategory`;

CREATE TABLE `category_subcategory`
(
    `category_id` INTEGER NOT NULL,
    `subcategory_id` INTEGER NOT NULL,
    INDEX `category_subcategory_fi_904832` (`category_id`),
    INDEX `category_subcategory_fi_49dd8c` (`subcategory_id`),
    CONSTRAINT `category_subcategory_fk_904832`
        FOREIGN KEY (`category_id`)
        REFERENCES `category` (`id`),
    CONSTRAINT `category_subcategory_fk_49dd8c`
        FOREIGN KEY (`subcategory_id`)
        REFERENCES `subcategory` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(65) NOT NULL,
    `productID` VARCHAR(65),
    `price` FLOAT,
    `quantity` INTEGER DEFAULT 0,
    `description` TEXT,
    `subcategory_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `product_fi_49dd8c` (`subcategory_id`),
    CONSTRAINT `product_fk_49dd8c`
        FOREIGN KEY (`subcategory_id`)
        REFERENCES `subcategory` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
