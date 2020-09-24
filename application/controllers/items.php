<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller 
{
	/**
	 * Item List
	 *
	 * @return View
	 */
	public function index()
	{
		$this->load->model('item_model', 'myItem', true);
		
		$data['items'] = $this->myItem->getList();

		$this->load->view('items/list', $data);
	}

	/**
	 * Edit
	 *
	 */
	public function edit($id = null)
	{
		$this->load->model('item_model', 'myItem', true);
		$data['item'] = $this->myItem->searchById($id);

		$this->load->view('items/edit', $data);
	}

	/**
	 * Update
	 *
	 * @return null
	 */ 
	public function update()
	{
		$input = $this->input->post();

		$this->load->model('item_model', 'myItem', true);

		$id 		= $input['itemId'];
		$inputData 	= [
			'title' 			=> $input['title'],
			'price_with_tax' 	=> $input['price_with_tax'],
			'description' 		=> $input['description']
		];

		$status = $this->myItem->updateItem($id, $inputData);

		if($status)
		{
			redirect('items', 'refresh');
		}

		redirect('/', 'refresh');
	}

	/**
	 * Delete
	 *
	 * @return null
	 **/
	public function delete()
	{
		$input = $this->input->post(); 

		if(isset($input['itemId']) && !empty($input['itemId']))
		{
			$this->load->model('item_model', 'myItem', true);
			$status = $this->myItem->deleteById($input['itemId']);

			if($status) {
				echo json_encode([
					'status' => true,
					'message' => 'Item Deleted Successfully.'
				]);
				exit;
			}
		}
		
		echo json_encode([
			'status' => false,
			'message' => 'unable to delete item.'
		]);
		exit;
	}
}