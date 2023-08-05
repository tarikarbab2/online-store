class Catgories {
    constructor(img,header){
        this.img=img;
        this.header=header;
    }

}
const container=document.querySelector('.categories__container')

const catgorie=[{img:'t-shirt-1.jpg',header:'أقمصة'},{img:'shoes-1.jpg',header:'احذية رياضية'},{img:'jeans-1.jpg',header:'جينز'},{img:'dress.-1jpg.jpg',header:'فساتين'}
,{img:'bags.-1jpg.jpg',header:'حقائب نسائية'},{img:'heels-1.jpg',header:'كعب عالي '}]

catgorie.forEach((arr)=>{
 
    let markup=`   <div class="categories__card"> <img src="./front-end/img/${arr.img}" alt="t-shirt-1" class="categories__img">
    <h1 class="categories__header">${arr.header}</h1></div>
    `
    container.insertAdjacentHTML('beforeend',markup);
})



