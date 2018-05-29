<?php
/**
 * Created by PhpStorm.
 * User: gx
 * Date: 29/05/18
 * Time: 16.13
 */

namespace grptx\grid;


use yii\grid\DataColumn;

class BooleanColumn extends DataColumn {
	/**
	 * @var string label for the true value. Defaults to `Active`.
	 */
	public $trueLabel;

	/**
	 * @var string label for the false value. Defaults to `Inactive`.
	 */
	public $falseLabel;

	/**
	 * @var string icon/indicator for the true value. If this is not set, it will use the value from `trueLabel`. If
	 * GridView `bootstrap` property is set to true - it will default to [[GridView::ICON_ACTIVE]].
	 */
	public $trueIcon;

	/**
	 * @var string icon/indicator for the false value. If this is null, it will use the value from `falseLabel`. If
	 * GridView `bootstrap` property is set to true - it will default to [[GridView::ICON_INACTIVE]].
	 */
	public $falseIcon;

	/**
	 * @var boolean whether to show null value as a false icon.
	 */
	public $showNullAsFalse = false;

	/**
	 * The **active** icon markup for [[BooleanColumn]]
	 */
	const ICON_ACTIVE = '<span class="glyphicon glyphicon-ok text-success"></span>';
	/**
	 * The **inactive** icon markup for [[BooleanColumn]]
	 */
	const ICON_INACTIVE = '<span class="glyphicon glyphicon-remove text-danger"></span>';

	/**
	 * @inheritdoc
	 */
	public function init() {
		if ( empty( $this->trueLabel ) ) {
			$this->trueLabel = 'Active';
		}
		if ( empty( $this->falseLabel ) ) {
			$this->falseLabel = 'Inactive';
		}
		$this->filter = [ true => $this->trueLabel, false => $this->falseLabel ];

		if ( empty( $this->trueIcon ) ) {
			$this->trueIcon = self::ICON_ACTIVE;
		}

		if ( empty( $this->falseIcon ) ) {
			$this->falseIcon = self::ICON_INACTIVE;
		}

		$this->format = 'raw';
		parent::init();
	}

	/**
	 * @inheritdoc
	 */
	public function getDataCellValue( $model, $key, $index ) {
		$value = parent::getDataCellValue( $model, $key, $index );
		if ( $value !== null ) {
			return $value ? $this->trueIcon : $this->falseIcon;
		}

		return $this->showNullAsFalse ? $this->falseIcon : $value;
	}
}