<?php
/**
 * Project telegram-messenger
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 21/02/2024
 * Time: 18:21
 */

namespace nguyenanhung\TelegramMessenger;

trait TelegramOptions
{
	/** @var null|int Unique identifier for the target message thread (topic) of the forum; for forum supergroups only */
	protected $message_thread_id = null;

	/** @var bool Sends the message silently. Users will receive a notification with no sound. */
	protected $disable_notification = false;

	/** @var bool Protects the contents of the sent message from forwarding and saving. */
	protected $protect_content = false;

	/** @var null|string Mode for parsing entities. See https://core.telegram.org/bots/api#formatting-options for more details. */
	protected $parse_mode = null;

	/** @var null|mixed A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode */
	protected $entities = null;

	/** @var null|mixed A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode */
	protected $caption_entities = null;

	/** @var null|mixed Link preview generation options for the message */
	protected $link_preview_options = null;

	/** @var null|mixed Description of the message to reply to */
	protected $reply_parameters = null;

	/** @var null|mixed Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user. */
	protected $reply_markup = null;

	/**
	 * Function setMessageThreadId
	 *
	 * @param $message_thread_id
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function setMessageThreadId($message_thread_id)
	{
		$this->message_thread_id = $message_thread_id;
		return $this;
	}

	/**
	 * Function setDisableNotification
	 *
	 * @param bool $disable_notification
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function setDisableNotification(bool $disable_notification)
	{
		$this->disable_notification = $disable_notification;
		return $this;
	}

	/**
	 * Function setProtectContent
	 *
	 * @param bool $protect_content
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function setProtectContent(bool $protect_content)
	{
		$this->protect_content = $protect_content;
		return $this;
	}

	/**
	 * Function setEntities
	 *
	 * @param $entities
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function setEntities($entities)
	{
		$this->entities = $entities;
		return $this;
	}

	/**
	 * Function setCaptionEntities
	 *
	 * @param $caption_entities
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function setCaptionEntities($caption_entities)
	{
		$this->caption_entities = $caption_entities;
		return $this;
	}

	/**
	 * Function setLinkPreviewOptions
	 *
	 * @param $link_preview_options
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function setLinkPreviewOptions($link_preview_options)
	{
		$this->link_preview_options = $link_preview_options;
		return $this;
	}

	/**
	 * Function setReplyParameters
	 *
	 * @param $reply_parameters
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function setReplyParameters($reply_parameters)
	{
		$this->reply_parameters = $reply_parameters;
		return $this;
	}

	/**
	 * Function setReplyMarkup
	 *
	 * @param $reply_markup
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function setReplyMarkup($reply_markup)
	{
		$this->reply_markup = $reply_markup;
		return $this;
	}

	/**
	 * Function setParseMode
	 *
	 * @param $parse_mode
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function setParseMode($parse_mode = '')
	{
		$this->parse_mode = $parse_mode;
		return $this;
	}

	/**
	 * Function parseModeMarkdown
	 *
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function parseModeMarkdown()
	{
		$this->parse_mode = 'MarkdownV2';
		return $this;
	}

	/**
	 * Function parseModeHTML
	 *
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return $this
	 */
	public function parseModeHTML()
	{
		$this->parse_mode = 'HTML';
		return $this;
	}

	/**
	 * Function getParseMode
	 *
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return string
	 */
	public function getParseMode()
	{
		return $this->parse_mode;
	}

	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Handing Optional ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

	/**
	 * Function handleOptions
	 *
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return array
	 */
	public function handleOptions()
	{
		$options = array();
		if (!empty($this->parse_mode)) {
			$options['parse_mode'] = $this->parse_mode;
		}
		if (!empty($this->message_thread_id)) {
			$options['message_thread_id'] = $this->message_thread_id;
		}
		if (!empty($this->entities)) {
			$options['entities'] = $this->entities;
		}
		if (!empty($this->caption_entities)) {
			$options['caption_entities'] = $this->caption_entities;
		}
		if (!empty($this->link_preview_options)) {
			$options['link_preview_options'] = $this->link_preview_options;
		}
		if (!empty($this->reply_parameters)) {
			$options['reply_parameters'] = $this->reply_parameters;
		}
		if (!empty($this->reply_markup)) {
			$options['reply_markup'] = $this->reply_markup;
		}
		if ($this->disable_notification === true) {
			$options['disable_notification'] = $this->disable_notification;
		}
		if ($this->protect_content === true) {
			$options['protect_content'] = $this->protect_content;
		}
		return $options;
	}

	/**
	 * Function bindParams
	 *
	 * @param $params
	 * User: 713uk13m <dev@nguyenanhung.com>
	 * Copyright: 713uk13m <dev@nguyenanhung.com>
	 * @return array|mixed
	 */
	public function bindParams($params = array())
	{
		$options = $this->handleOptions();
		return array_merge($params, $options);
	}
}
