<?php
namespace MooPhp\MooInterface\Data\Template\Items;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ImageConstraints {

	/**
	 * @var \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
	 */
	protected $_leftEdge;

	/**
	 * @var \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
	 */
	protected $_rightEdge;

	/**
	 * @var \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
	 */
	protected $_topEdge;

	/**
	 * @var \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
	 */
	protected $_bottomEdge;


	/**
	 * @return \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
	 */
	public function getBottomEdge() {
		return $this->_bottomEdge;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
	 */
	public function getLeftEdge() {
		return $this->_leftEdge;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
	 */
	public function getRightEdge() {
		return $this->_rightEdge;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
	 */
	public function getTopEdge() {
		return $this->_topEdge;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint $bottomEdge
	 */
	public function setBottomEdge($bottomEdge) {
		$this->_bottomEdge = $bottomEdge;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint $leftEdge
	 */
	public function setLeftEdge($leftEdge) {
		$this->_leftEdge = $leftEdge;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint $rightEdge
	 */
	public function setRightEdge($rightEdge) {
		$this->_rightEdge = $rightEdge;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint $topEdge
	 */
	public function setTopEdge($topEdge) {
		$this->_topEdge = $topEdge;
	}


}
