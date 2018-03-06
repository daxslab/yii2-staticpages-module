<?php

namespace daxslab\staticpages\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 * Has foreign keys to the tables:
 *
 * - `page`
 */
class m180306_032829_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'language' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->unique()->notNull(),
            'abstract' => $this->text()->null(),
            'body' => $this->text()->notNull(),
            'image' => $this->string()->null(),
            'keywords' => $this->string()->null(),
            'parent_id' => $this->integer()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-page-parent_id',
            'page',
            'parent_id'
        );

        // add foreign key for table `page`
        $this->addForeignKey(
            'fk-page-parent_id',
            'page',
            'parent_id',
            'page',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `page`
        $this->dropForeignKey(
            'fk-page-parent_id',
            'page'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            'idx-page-parent_id',
            'page'
        );

        $this->dropTable('page');
    }
}
