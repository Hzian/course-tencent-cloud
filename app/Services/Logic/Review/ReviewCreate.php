<?php

namespace App\Services\Logic\Review;

use App\Models\Course as CourseModel;
use App\Models\Review as ReviewModel;
use App\Services\CourseStat as CourseStatService;
use App\Services\Logic\CourseTrait;
use App\Services\Logic\ReviewTrait;
use App\Services\Logic\Service;
use App\Validators\CourseUser as CourseUserValidator;
use App\Validators\Review as ReviewValidator;

class ReviewCreate extends Service
{

    use CourseTrait;
    use ReviewTrait;

    public function handle()
    {
        $post = $this->request->getPost();

        $course = $this->checkCourseCache($post['course_id']);

        $user = $this->getLoginUser();

        $validator = new CourseUserValidator();

        $validator->checkCourseUser($course->id, $user->id);
        $validator->checkIfReviewed($course->id, $user->id);

        $validator = new ReviewValidator();

        $data = [
            'course_id' => $course->id,
            'owner_id' => $user->id,
        ];

        $data['content'] = $validator->checkContent($post['content']);
        $data['rating1'] = $validator->checkRating($post['rating1']);
        $data['rating2'] = $validator->checkRating($post['rating2']);
        $data['rating3'] = $validator->checkRating($post['rating3']);

        $review = new ReviewModel();

        $review->create($data);

        $this->incrCourseReviewCount($course);

        $this->updateCourseRating($course->id);

        return $review;
    }

    protected function incrCourseReviewCount(CourseModel $course)
    {
        $course->review_count += 1;

        $course->update();
    }

    public function updateCourseRating($courseId)
    {
        $service = new CourseStatService();

        $service->updateRating($courseId);
    }

}
