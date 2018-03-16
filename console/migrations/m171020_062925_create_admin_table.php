<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171020_062925_create_admin_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%admin_post}}', [
            'id' => $this->primaryKey(),
            'post_name' => $this->string(100)->notNull(),
            'admin' => $this->smallInteger()->notNull()->defaultValue(0),
            'product_reviews' => $this->smallInteger()->notNull()->defaultValue(0),
            'order' => $this->smallInteger()->notNull()->defaultValue(0),
            'vendor' => $this->smallInteger()->notNull()->defaultValue(0),
            'users' => $this->smallInteger()->notNull()->defaultValue(0),
            'promotions' => $this->smallInteger()->notNull()->defaultValue(0),
            'masters' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'CB' => $this->integer()->notNull(),
            'UB' => $this->integer()->notNull(),
            'DOC' => $this->date(),
            'DOU' => $this->timestamp(),
                ], $tableOptions);
        $this->alterColumn('{{%admin_post}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

        $this->createTable('{{%admin_users}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'user_name' => $this->string(30)->notNull(),
            'password' => $this->string(300)->notNull(),
            'name' => $this->string(100),
            'email' => $this->string(100),
            'phone' => $this->string(15),
            'address' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'CB' => $this->integer()->notNull(),
            'UB' => $this->integer()->notNull(),
            'DOC' => $this->date(),
            'DOU' => $this->timestamp(),
                ], $tableOptions);
        $this->alterColumn('{{%admin_users}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

        $this->createIndex('post_id', 'admin_users', 'post_id', $unique = false);
        $this->addForeignKey("", "admin_users", "post_id", "admin_post", "id", "RESTRICT", "RESTRICT");
        $this->insert('admin_post', ['id' => '1', 'post_name' => 'super_admin', 'admin' => 1, 'product_reviews' => 1, 'order' => 1, 'vendor' => 1, 'users' => 1, 'promotions' => 1, 'masters' => 1, 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-10-20', 'DOU' => '2017-10-20 16:11:28']);
        $this->insert('admin_users', ['id' => '1', 'post_id' => 1, 'user_name' => 'testing', 'password' => '$2y$13$RS.hkV5A0BeKtCGGzql6yO7lZ2MblwFkNxxixzsf3NbuZwFphLhyi', 'name' => 'testing', 'email' => 'test@test.com', 'phone' => '', 'status' => '1', 'CB' => '1', 'UB' => '1', 'DOC' => '2017-10-20', 'DOU' => '2017-10-20 16:11:28']);
    }

    public function down() {
        echo "m171020_062925_create_admin_table cannot be reverted.\n";

        return false;
    }

}
