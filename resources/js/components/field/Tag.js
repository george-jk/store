export default class Tag{
	data(){
		textarea:{
			// valid:false
		}
	}
	constructor(text){
		this.textarea=text;
		return this;
	}
	insertTag(tag,offset=0){
		if (offset==0) {
			offset=(tag.length-1)/2;
		}
		let start=this.textarea.ta.selectionStart;
		let end=this.textarea.ta.selectionEnd+offset;
		this.textarea.ta.value=this.textarea.ta.value.substring(0,start)
			+tag+this.textarea.ta.value.substring(start);
		this.textarea.ta.focus();
		this.textarea.ta.selectionEnd=end;

		return this.textarea.ta.value;
	}

}