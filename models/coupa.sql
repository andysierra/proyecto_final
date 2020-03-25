-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema coupa
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema coupa
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `coupa` DEFAULT CHARACTER SET latin1 ;
USE `coupa` ;

-- -----------------------------------------------------
-- Table `coupa`.`buyer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`buyer` (
  `idbuyer` INT NOT NULL AUTO_INCREMENT,
  `fname` TEXT NULL,
  `sname` TEXT NULL,
  `email` TEXT NOT NULL,
  `password` TEXT NOT NULL,
  `phone` TEXT NULL,
  `spend_limit` DECIMAL(13,2) NULL,
  `profilepic` TEXT NULL,
  `next_approver` INT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idbuyer`, `next_approver`),
  INDEX `fk_buyer_buyer1_idx` (`next_approver` ASC) ,
  CONSTRAINT `fk_buyer_buyer1`
    FOREIGN KEY (`next_approver`)
    REFERENCES `coupa`.`buyer` (`idbuyer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`supplier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`supplier` (
  `idsupplier` INT NOT NULL AUTO_INCREMENT,
  `fname` TEXT NULL,
  `sname` TEXT NULL,
  `email` TEXT NOT NULL,
  `password` TEXT NOT NULL,
  `phone` TEXT NULL,
  `profilepic` TEXT NULL,
  `commercial_name` TEXT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idsupplier`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`replenisher`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`replenisher` (
  `idreplenisher` INT NOT NULL AUTO_INCREMENT,
  `fname` TEXT NULL,
  `sname` TEXT NULL,
  `email` TEXT NOT NULL,
  `password` TEXT NOT NULL,
  `phone` TEXT NULL,
  `profilepic` TEXT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idreplenisher`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`contract`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`contract` (
  `idcontract` INT NOT NULL,
  `name` TEXT NULL,
  `policy` TEXT NULL,
  `supplier` INT NOT NULL,
  `active` TINYINT(1) NOT NULL,
  `replenisher` INT NOT NULL,
  PRIMARY KEY (`idcontract`, `supplier`, `replenisher`),
  INDEX `fk_contract_supplier_idx` (`supplier` ASC) ,
  INDEX `fk_contract_replenisher1_idx` (`replenisher` ASC) ,
  CONSTRAINT `fk_contract_supplier`
    FOREIGN KEY (`supplier`)
    REFERENCES `coupa`.`supplier` (`idsupplier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contract_replenisher1`
    FOREIGN KEY (`replenisher`)
    REFERENCES `coupa`.`replenisher` (`idreplenisher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`warehouse`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`warehouse` (
  `idwarehouse` INT NOT NULL AUTO_INCREMENT,
  `name` TEXT NULL,
  `active` TINYINT(1) NOT NULL,
  `replenisher` INT NOT NULL,
  PRIMARY KEY (`idwarehouse`, `replenisher`),
  INDEX `fk_warehouse_replenisher1_idx` (`replenisher` ASC) ,
  CONSTRAINT `fk_warehouse_replenisher1`
    FOREIGN KEY (`replenisher`)
    REFERENCES `coupa`.`replenisher` (`idreplenisher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`item` (
  `iditem` INT NOT NULL AUTO_INCREMENT,
  `name` TEXT NULL,
  `description` TEXT NULL,
  `photo` TEXT NULL,
  `warehouse` INT NOT NULL,
  `active` TINYINT(1) NOT NULL,
  `replenisher` INT NOT NULL,
  PRIMARY KEY (`iditem`, `warehouse`, `replenisher`),
  INDEX `fk_item_warehouse1_idx` (`warehouse` ASC) ,
  INDEX `fk_item_replenisher1_idx` (`replenisher` ASC) ,
  CONSTRAINT `fk_item_warehouse1`
    FOREIGN KEY (`warehouse`)
    REFERENCES `coupa`.`warehouse` (`idwarehouse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_replenisher1`
    FOREIGN KEY (`replenisher`)
    REFERENCES `coupa`.`replenisher` (`idreplenisher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`item_has_contract`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`item_has_contract` (
  `id` INT NOT NULL,
  `item` INT NULL,
  `contract` INT NULL,
  `price` DECIMAL(13,2) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_item_has_contract_contract1_idx` (`contract` ASC) ,
  INDEX `fk_item_has_contract_item1_idx` (`item` ASC) ,
  CONSTRAINT `fk_item_has_contract_item1`
    FOREIGN KEY (`item`)
    REFERENCES `coupa`.`item` (`iditem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_has_contract_contract1`
    FOREIGN KEY (`contract`)
    REFERENCES `coupa`.`contract` (`idcontract`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`commodity`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`commodity` (
  `idcommodity` INT NOT NULL AUTO_INCREMENT,
  `name` TEXT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idcommodity`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`item_has_commodity`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`item_has_commodity` (
  `id` INT NOT NULL,
  `item` INT NULL,
  `commodity` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_item_has_commodity_commodity1_idx` (`commodity` ASC) ,
  INDEX `fk_item_has_commodity_item1_idx` (`item` ASC) ,
  CONSTRAINT `fk_item_has_commodity_item1`
    FOREIGN KEY (`item`)
    REFERENCES `coupa`.`item` (`iditem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_has_commodity_commodity1`
    FOREIGN KEY (`commodity`)
    REFERENCES `coupa`.`commodity` (`idcommodity`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`requisition`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`requisition` (
  `idrequisition` INT NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idrequisition`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`requisition_has_buyer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`requisition_has_buyer` (
  `id` INT NOT NULL,
  `buyer` INT NULL,
  `requisition` INT NULL,
  `role` TINYINT(1) NOT NULL,
  `approval` TINYINT(1) NULL,
  `comment` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_buyer_has_requisition_requisition1_idx` (`requisition` ASC) ,
  INDEX `fk_buyer_has_requisition_buyer1_idx` (`buyer` ASC) ,
  CONSTRAINT `fk_buyer_has_requisition_buyer1`
    FOREIGN KEY (`buyer`)
    REFERENCES `coupa`.`buyer` (`idbuyer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_buyer_has_requisition_requisition1`
    FOREIGN KEY (`requisition`)
    REFERENCES `coupa`.`requisition` (`idrequisition`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`purchase_order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`purchase_order` (
  `idpurchase_order` INT NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL,
  `requisition` INT NOT NULL,
  `supplier` INT NOT NULL,
  PRIMARY KEY (`idpurchase_order`, `requisition`, `supplier`),
  INDEX `fk_purchase_order_requisition1_idx` (`requisition` ASC) ,
  INDEX `fk_purchase_order_supplier1_idx` (`supplier` ASC) ,
  CONSTRAINT `fk_purchase_order_requisition1`
    FOREIGN KEY (`requisition`)
    REFERENCES `coupa`.`requisition` (`idrequisition`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_purchase_order_supplier1`
    FOREIGN KEY (`supplier`)
    REFERENCES `coupa`.`supplier` (`idsupplier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`requisition_has_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`requisition_has_item` (
  `id` INT NOT NULL,
  `requisition` INT NULL,
  `item` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_requisition_has_item_item1_idx` (`item` ASC) ,
  INDEX `fk_requisition_has_item_requisition1_idx` (`requisition` ASC) ,
  CONSTRAINT `fk_requisition_has_item_requisition1`
    FOREIGN KEY (`requisition`)
    REFERENCES `coupa`.`requisition` (`idrequisition`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisition_has_item_item1`
    FOREIGN KEY (`item`)
    REFERENCES `coupa`.`item` (`iditem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`purchase_order_has_buyer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`purchase_order_has_buyer` (
  `id` INT NOT NULL,
  `purchase_order` INT NULL,
  `buyer` INT NULL,
  `role` TINYINT(1) NOT NULL,
  `comment` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_purchase_order_has_buyer_buyer1_idx` (`buyer` ASC) ,
  INDEX `fk_purchase_order_has_buyer_purchase_order1_idx` (`purchase_order` ASC) ,
  CONSTRAINT `fk_purchase_order_has_buyer_purchase_order1`
    FOREIGN KEY (`purchase_order`)
    REFERENCES `coupa`.`purchase_order` (`idpurchase_order`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_purchase_order_has_buyer_buyer1`
    FOREIGN KEY (`buyer`)
    REFERENCES `coupa`.`buyer` (`idbuyer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`purchase_order_has_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`purchase_order_has_item` (
  `id` INT NOT NULL,
  `purchase_order` INT NULL,
  `item` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_purchase_order_has_item_item1_idx` (`item` ASC) ,
  INDEX `fk_purchase_order_has_item_purchase_order1_idx` (`purchase_order` ASC) ,
  CONSTRAINT `fk_purchase_order_has_item_purchase_order1`
    FOREIGN KEY (`purchase_order`)
    REFERENCES `coupa`.`purchase_order` (`idpurchase_order`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_purchase_order_has_item_item1`
    FOREIGN KEY (`item`)
    REFERENCES `coupa`.`item` (`iditem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`receipt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`receipt` (
  `idreceipt` INT NOT NULL,
  `status` TINYINT(1) NOT NULL,
  `purchase_order` INT NOT NULL,
  PRIMARY KEY (`idreceipt`, `purchase_order`),
  INDEX `fk_receipt_purchase_order1_idx` (`purchase_order` ASC) ,
  CONSTRAINT `fk_receipt_purchase_order1`
    FOREIGN KEY (`purchase_order`)
    REFERENCES `coupa`.`purchase_order` (`idpurchase_order`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`receipt_has_buyer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`receipt_has_buyer` (
  `id` INT NOT NULL,
  `receipt` INT NULL,
  `buyer` INT NULL,
  `comment` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_receipt_has_buyer_buyer1_idx` (`buyer` ASC) ,
  INDEX `fk_receipt_has_buyer_receipt1_idx` (`receipt` ASC) ,
  CONSTRAINT `fk_receipt_has_buyer_receipt1`
    FOREIGN KEY (`receipt`)
    REFERENCES `coupa`.`receipt` (`idreceipt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_receipt_has_buyer_buyer1`
    FOREIGN KEY (`buyer`)
    REFERENCES `coupa`.`buyer` (`idbuyer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`receipt_has_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`receipt_has_item` (
  `id` INT NOT NULL,
  `receipt` INT NULL,
  `item` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_receipt_has_item_item1_idx` (`item` ASC) ,
  INDEX `fk_receipt_has_item_receipt1_idx` (`receipt` ASC) ,
  CONSTRAINT `fk_receipt_has_item_receipt1`
    FOREIGN KEY (`receipt`)
    REFERENCES `coupa`.`receipt` (`idreceipt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_receipt_has_item_item1`
    FOREIGN KEY (`item`)
    REFERENCES `coupa`.`item` (`iditem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`invoice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`invoice` (
  `idinvoice` INT NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL,
  `receipt` INT NOT NULL,
  `supplier` INT NOT NULL,
  PRIMARY KEY (`idinvoice`, `receipt`, `supplier`),
  INDEX `fk_invoice_receipt1_idx` (`receipt` ASC) ,
  INDEX `fk_invoice_supplier1_idx` (`supplier` ASC) ,
  CONSTRAINT `fk_invoice_receipt1`
    FOREIGN KEY (`receipt`)
    REFERENCES `coupa`.`receipt` (`idreceipt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_supplier1`
    FOREIGN KEY (`supplier`)
    REFERENCES `coupa`.`supplier` (`idsupplier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`invoice_has_buyer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`invoice_has_buyer` (
  `id` INT NOT NULL,
  `invoice` INT NULL,
  `buyer` INT NULL,
  `role` TINYINT(1) NOT NULL,
  `approval` TINYINT(1) NULL,
  `comment` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_invoice_has_buyer_buyer1_idx` (`buyer` ASC) ,
  INDEX `fk_invoice_has_buyer_invoice1_idx` (`invoice` ASC) ,
  CONSTRAINT `fk_invoice_has_buyer_invoice1`
    FOREIGN KEY (`invoice`)
    REFERENCES `coupa`.`invoice` (`idinvoice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_has_buyer_buyer1`
    FOREIGN KEY (`buyer`)
    REFERENCES `coupa`.`buyer` (`idbuyer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`invoice_has_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`invoice_has_item` (
  `id` INT NOT NULL,
  `invoice` INT NULL,
  `item` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_invoice_has_item_item1_idx` (`item` ASC) ,
  INDEX `fk_invoice_has_item_invoice1_idx` (`invoice` ASC) ,
  CONSTRAINT `fk_invoice_has_item_invoice1`
    FOREIGN KEY (`invoice`)
    REFERENCES `coupa`.`invoice` (`idinvoice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_has_item_item1`
    FOREIGN KEY (`item`)
    REFERENCES `coupa`.`item` (`iditem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`requisition_has_supplier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`requisition_has_supplier` (
  `id` INT NOT NULL,
  `requisition` INT NULL,
  `supplier` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_requisition_has_supplier_supplier1_idx` (`supplier` ASC) ,
  INDEX `fk_requisition_has_supplier_requisition1_idx` (`requisition` ASC) ,
  CONSTRAINT `fk_requisition_has_supplier_requisition1`
    FOREIGN KEY (`requisition`)
    REFERENCES `coupa`.`requisition` (`idrequisition`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisition_has_supplier_supplier1`
    FOREIGN KEY (`supplier`)
    REFERENCES `coupa`.`supplier` (`idsupplier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`tag`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`tag` (
  `idtag` INT NOT NULL,
  `name` TEXT NULL,
  `item` INT NOT NULL,
  PRIMARY KEY (`idtag`, `item`),
  INDEX `fk_tag_item1_idx` (`item` ASC) ,
  CONSTRAINT `fk_tag_item1`
    FOREIGN KEY (`item`)
    REFERENCES `coupa`.`item` (`iditem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupa`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `coupa`.`admin` (
  `idadmin` INT NOT NULL AUTO_INCREMENT,
  `fname` TEXT NULL,
  `sname` TEXT NULL,
  `email` TEXT NOT NULL,
  `password` TEXT NOT NULL,
  `phone` TEXT NULL,
  `profilepic` TEXT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idadmin`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
