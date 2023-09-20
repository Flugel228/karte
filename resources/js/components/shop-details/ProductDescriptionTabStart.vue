<script setup lang="ts">
import {IProps} from "../../types/components/shop-details/product-description-tab-start";
import StarRating from "../rate/StarRating.vue";
import {computed, ref} from "vue";
import api from "../../axios/api";

const props = defineProps<IProps>();

// refs
const rate = ref<number>(0);
const title = ref<string>('');
const comment = ref<string>('');
const length = 5;

// computed methods
const commentLength = computed((): number => {
    if (comment.value.length > 1500) {
        comment.value = comment.value.slice(0,1500);
    }
    return comment.value.length;
});

// methods
const changeRate = (number: number): void => {
    rate.value = number;
}

const submitReview = async (): Promise<void> => {
    await api.post('/api/users/auth/products/comments',{
        product_id:  props.id,
        title: title.value,
        comment: comment.value,
        rate: rate.value
    })
    await props.fetchProduct(props.id.toString());
}
</script>

<template>
    <section class="product pt-60 pb-60 wow fadeInUp overflow-hidden"
             style="visibility: visible; animation-name: fadeInUp;">
        <div class="container">
            <div class="row wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="col-12">
                    <ul class="nav product-details-nav nav-one nav-pills justify-content-center" id="pills-tab-two"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-description" type="button" role="tab"
                                    aria-controls="pills-description" aria-selected="true">
                                Описание
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-review-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-review" type="button" role="tab"
                                    aria-controls="pills-review" aria-selected="false"> Отзывы
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="tab-content" id="pills-tabContent-two">
                    <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                         aria-labelledby="pills-description-tab">
                        <div class="product-drescription">
                            <h4> Описание продукта:</h4>
                            <p v-html="description"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                        <div class="product-drescription">
                            <div
                                v-for="(comment, id) in productComments"
                                :key="id"
                                class="review-single"
                            >
                                <div class="left">
                                    <div class="ratting">
                                        <i
                                            v-for="(item, id) in length"
                                            :key="id"
                                            :class="['flaticon-star-1', {'unselected': comment.rate < id + 1}]"
                                        ></i>
                                    </div>
                                    <h6>{{comment.title}} <span>{{ comment.user.first_name }} {{ comment.user.last_name}} {{ comment.date }}</span></h6>
                                    <p>{{ comment.comment }}</p>
                                </div>
                            </div>
                            <div class="review-from-box mt-30">
                                <h6>Написать отзыв</h6>
                                <form action="#" class="review-from">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ratting-box">
                                                <p> РЕЙТИНГ </p>
                                                <StarRating
                                                    :length="length"
                                                    :rate="rate"
                                                    :change-rate="changeRate"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="title"> НАЗВАНИЕ ОТЗЫВА</label>
                                                <input
                                                    v-model="title"
                                                    type="text"
                                                    id="title"
                                                    class="form-control"
                                                    placeholder="Дайте название отзыва"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group m-0">
                                                <label for="comment">ОСНОВНАЯ ЧАСТЬ ОТЗЫВА ({{ commentLength }}/1500)</label>
                                                <textarea
                                                    id="comment"
                                                    placeholder="Напишите ваш комментарий здесь"
                                                    v-model="comment"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        @click.prevent="submitReview"
                                        type="submit"
                                        class="btn--primary style2 "
                                    >Отправить отзыв</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped lang="sass">
.ratting i.unselected
    color: #dddddd
</style>
