<?php

namespace app\models;

use Yii;
use app\models\Author;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\data\Sort;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int $publication_year
 * @property string $description
 * @property string $isbn
 * @property string|null $preview
 * @property string $created_at
 */
class Book extends \yii\db\ActiveRecord
{

    public $selectedAuthors = [];
    public $previewFile;
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'publication_year', 'description', 'isbn'], 'required'],
            [['publication_year'], 'integer'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['title', 'preview'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 13],
            [['previewFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            $this->previewFile = UploadedFile::getInstance($this,'previewFile');
            if (!empty($this->previewFile)) {
                $this->previewFile->saveAs('uploads/' . $this->previewFile->baseName . '.' . $this->previewFile->extension);
                $this->preview = $this->previewFile->baseName . '.' . $this->previewFile->extension;
                $this->save(false, ['preview']);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'title' => 'Название',
            'publication_year' => 'Год публикации',
            'description' => 'Описание',
            'isbn' => 'ISBN',
            'preview' => 'Превью',
            'created_at' => 'Дата добавления',
            'authorLabel' => 'Авторы'
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\queries\BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\BookQuery(get_called_class());
    }

    public function getAuthors() 
    {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])
          ->viaTable('author_book', ['book_id' => 'id']);
    }

    public function getAuthorsToList() 
    {
        $authors = Author::find()->all();
        $list = ArrayHelper::map($authors,'id','name');

        return $list;
    }

    public function getAuthorLabel()
    {
        $result = '';

        foreach($this->getAuthors()->all() as $author) {
            $result .= empty($result) ? $author->name : ', '. $author->name;
        }

        return $result;
    }

    public function getTopPopularByYear($year)
    {
        return Author::find()
            ->select('author.firstname, author.lastname, author.patronymic, COUNT(book.id) as bookCount')
            ->leftJoin('author_book', 'author_book.author_id = author.id')
            ->leftJoin('book', 'author_book.book_id = book.id')
            ->where('book.publication_year = :year', [':year' => $year])
            ->groupBy('author.id')
            ->orderBy(['COUNT(book.id)' => SORT_DESC])
            ->limit(10)
            ->all();
    }
}
